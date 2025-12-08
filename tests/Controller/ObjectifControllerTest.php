<?php

namespace App\Tests\Controller;

use App\Entity\Objectif;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ObjectifControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private string $path = '/objectif/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();

        // Nettoyage
        foreach ($this->manager->getRepository(Objectif::class)->findAll() as $object) {
            $this->manager->remove($object);
        }
        $this->manager->flush();

        // Création d'un faux utilisateur loggé (sinon getUser() = null)
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setPassword('test'); // hash non nécessaire pour tests fonctionnels

        $this->manager->persist($user);
        $this->manager->flush();

        // Connexion automatique de l'utilisateur en test
        $this->client->loginUser($user);
    }

    public function testIndexPageLoads(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertSelectorTextContains('h1', 'Objectifs sportifs');
    }

    public function testCreateObjectifFromIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        // Soumission du formulaire intégré à l'index
        $this->client->submitForm('Enregistrer', [
            'objectif[type_objectif]' => 'distance',
            'objectif[valeur_cible]' => 10,
            'objectif[date_limite]' => '2030-01-01',
        ]);

        self::assertResponseRedirects($this->path);

        $this->client->followRedirect();

        $objectifs = $this->manager->getRepository(Objectif::class)->findAll();
        self::assertCount(1, $objectifs);
        self::assertSame(10, $objectifs[0]->getValeurCible());
    }

    public function testEditObjectifFromIndex(): void
    {
        // Création d’un objectif existant
        $objectif = new Objectif();
        $objectif->setUser($this->manager->getRepository(User::class)->findOneBy([]));
        $objectif->setTypeObjectif('distance');
        $objectif->setValeurCible(10);
        $objectif->setDateLimite(new \DateTime('2030-01-01'));

        $this->manager->persist($objectif);
        $this->manager->flush();

        // Charger page index avec objectif existant
        $crawler = $this->client->request('GET', $this->path . '?edit=' . $objectif->getId());

        // On soumet avec nouvelles valeurs
        $this->client->submitForm('Enregistrer', [
            'objectif[type_objectif]' => 'temps',
            'objectif[valeur_cible]' => 20,
            'objectif[date_limite]' => '2030-05-05',
        ]);

        self::assertResponseRedirects($this->path);

        $updated = $this->manager->getRepository(Objectif::class)->find($objectif->getId());

        self::assertSame(20, $updated->getValeurCible());
        self::assertSame('temps', $updated->getTypeObjectif());
    }
}
