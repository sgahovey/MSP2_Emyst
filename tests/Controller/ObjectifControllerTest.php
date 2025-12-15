<?php

namespace App\Tests\Controller;

use App\Entity\Objectif;
use App\Entity\User;
use App\Enum\TypeObjectifEnum;
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

        // Nettoyage complet : Objectifs et Users
        foreach ($this->manager->getRepository(Objectif::class)->findAll() as $object) {
            $this->manager->remove($object);
        }
        foreach ($this->manager->getRepository(User::class)->findAll() as $user) {
            $this->manager->remove($user);
        }
        $this->manager->flush();

        // Création d'un faux utilisateur loggé (sinon getUser() = null)
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setName('Test User');
        $user->setPassword('test'); // hash non nécessaire pour tests fonctionnels

        $this->manager->persist($user);
        $this->manager->flush();

        // Connexion automatique de l'utilisateur en test
        $this->client->loginUser($user);
    }

    public function testIndexPageLoads(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertSelectorTextContains('h1', 'Objectifs sportifs');
    }

    public function testCreateObjectifFromIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        // Vérifier que la page contient un formulaire
        self::assertSelectorExists('form');

        // Trouver le formulaire et le soumettre en utilisant le bouton submit
        $form = $crawler->filter('form')->form([
            'objectif[type_objectif]' => TypeObjectifEnum::AUGMENTATION_FORCE->value,
            'objectif[valeur_cible]' => 10,
            'objectif[date_limite]' => '2030-01-01',
        ]);

        $this->client->submit($form);

        self::assertResponseRedirects($this->path);

        $this->client->followRedirect();

        $objectifs = $this->manager->getRepository(Objectif::class)->findAll();
        self::assertCount(1, $objectifs);
        self::assertSame(10, $objectifs[0]->getValeurCible());
    }

    public function testEditObjectifFromIndex(): void
    {
        // Création d'un objectif existant
        $objectif = new Objectif();
        $objectif->setUser($this->manager->getRepository(User::class)->findOneBy([]));
        $objectif->setTypeObjectif(TypeObjectifEnum::AUGMENTATION_FORCE);
        $objectif->setValeurCible(10);
        $objectif->setDateLimite(new \DateTimeImmutable('2030-01-01'));

        $this->manager->persist($objectif);
        $this->manager->flush();

        // Charger page index avec objectif existant
        $crawler = $this->client->request('GET', $this->path . '?edit=' . $objectif->getId());

        // Vérifier que la page contient un formulaire
        self::assertSelectorExists('form');

        // On soumet avec nouvelles valeurs en utilisant le formulaire
        $form = $crawler->filter('form')->form([
            'objectif[type_objectif]' => TypeObjectifEnum::ENDURANCE->value,
            'objectif[valeur_cible]' => 20,
            'objectif[date_limite]' => '2030-05-05',
        ]);

        $this->client->submit($form);

        self::assertResponseRedirects($this->path);

        $updated = $this->manager->getRepository(Objectif::class)->find($objectif->getId());

        self::assertSame(20, $updated->getValeurCible());
        self::assertSame(TypeObjectifEnum::ENDURANCE, $updated->getTypeObjectif());
    }
}
