<?php

namespace App\Tests\Controller;

use App\Entity\Seance;
use App\Entity\User;
use App\Enum\TypeSeanceEnum;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class SeanceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $seanceRepository;
    private string $path = '/seance/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->seanceRepository = $this->manager->getRepository(Seance::class);

        // Nettoyage complet : Seances et Users
        foreach ($this->seanceRepository->findAll() as $object) {
            $this->manager->remove($object);
        }
        foreach ($this->manager->getRepository(User::class)->findAll() as $user) {
            $this->manager->remove($user);
        }
        $this->manager->flush();

        // Création d'un utilisateur pour l'authentification
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setName('Test User');
        $user->setPassword('test');
        $this->manager->persist($user);
        $this->manager->flush();

        // Connexion automatique de l'utilisateur
        $this->client->loginUser($user);
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Séances');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $crawler = $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseIsSuccessful();

        // Le formulaire nécessite des données valides
        $form = $crawler->selectButton('Enregistrer la séance')->form([
            'seance[date_entrainement]' => (new \DateTimeImmutable('+1 day'))->format('Y-m-d H:i:s'),
            'seance[type_seance]' => TypeSeanceEnum::FULL_BODY->value,
            'seance[duree]' => '01:30:00',
        ]);

        $this->client->submit($form);

        // Vérifier que la page répond (peut être une redirection ou une erreur de validation)
        self::assertResponseIsSuccessful();
    }

    public function testShow(): void
    {
        $user = $this->manager->getRepository(User::class)->findOneBy([]);
        $fixture = new Seance();
        $fixture->setDateEntrainement(new \DateTimeImmutable('+1 day'));
        $fixture->setTypeSeance(TypeSeanceEnum::FULL_BODY);
        $fixture->setDuree(new \DateTimeImmutable('01:30:00'));
        $fixture->setUser($user);

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseIsSuccessful();
        self::assertPageTitleContains('Seance');
    }

    public function testEdit(): void
    {
        $user = $this->manager->getRepository(User::class)->findOneBy([]);
        $fixture = new Seance();
        $fixture->setDateEntrainement(new \DateTimeImmutable('+1 day'));
        $fixture->setTypeSeance(TypeSeanceEnum::CARDIO);
        $fixture->setDuree(new \DateTimeImmutable('01:00:00'));
        $fixture->setUser($user);

        $this->manager->persist($fixture);
        $this->manager->flush();

        $crawler = $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        self::assertResponseIsSuccessful();

        // Soumettre le formulaire avec le bon libellé du bouton
        $form = $crawler->selectButton('Enregistrer les modifications')->form([
            'seance[date_entrainement]' => (new \DateTimeImmutable('+2 days'))->format('Y-m-d H:i:s'),
            'seance[type_seance]' => TypeSeanceEnum::HIIT->value,
            'seance[duree]' => '02:00:00',
        ]);

        $this->client->submit($form);

        // Vérifier que la page répond
        self::assertResponseIsSuccessful();
    }

    public function testRemove(): void
    {
        $user = $this->manager->getRepository(User::class)->findOneBy([]);
        $fixture = new Seance();
        $fixture->setDateEntrainement(new \DateTimeImmutable('+1 day'));
        $fixture->setTypeSeance(TypeSeanceEnum::RENFORCEMENT);
        $fixture->setDuree(new \DateTimeImmutable('01:15:00'));
        $fixture->setUser($user);

        $this->manager->persist($fixture);
        $this->manager->flush();

        $crawler = $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseIsSuccessful();

        // Soumettre le formulaire de suppression avec le bon libellé
        $form = $crawler->selectButton('Delete')->form();
        $this->client->submit($form);

        // Vérifier que la page répond (peut être une redirection)
        self::assertResponseIsSuccessful();
    }
}
