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

        // Nettoyage
        foreach ($this->seanceRepository->findAll() as $object) {
            $this->manager->remove($object);
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
        self::assertPageTitleContains('Seance index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'seance[date_entrainement]' => 'Testing',
            'seance[type_seance]' => 'Testing',
            'seance[duree]' => 'Testing',
            'seance[user]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->seanceRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $user = $this->manager->getRepository(User::class)->findOneBy([]);
        $fixture = new Seance();
        $fixture->setDateEntrainement(new \DateTimeImmutable('+1 day'));
        $fixture->setTypeSeance(TypeSeanceEnum::FULL_BODY);
        $fixture->setDuree(new \DateTimeImmutable('01:30:00'));
        $fixture->setUser($user);

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Seance');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $user = $this->manager->getRepository(User::class)->findOneBy([]);
        $fixture = new Seance();
        $fixture->setDateEntrainement(new \DateTimeImmutable('+1 day'));
        $fixture->setTypeSeance(TypeSeanceEnum::CARDIO);
        $fixture->setDuree(new \DateTimeImmutable('01:00:00'));
        $fixture->setUser($user);

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'seance[date_entrainement]' => '2030-12-31',
            'seance[type_seance]' => TypeSeanceEnum::HIIT->value,
            'seance[duree]' => '02:00:00',
        ]);

        self::assertResponseRedirects('/seance/');

        $updated = $this->seanceRepository->find($fixture->getId());

        self::assertNotNull($updated->getDateEntrainement());
        self::assertSame(TypeSeanceEnum::HIIT, $updated->getTypeSeance());
        self::assertNotNull($updated->getDuree());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $user = $this->manager->getRepository(User::class)->findOneBy([]);
        $fixture = new Seance();
        $fixture->setDateEntrainement(new \DateTimeImmutable('+1 day'));
        $fixture->setTypeSeance(TypeSeanceEnum::RENFORCEMENT);
        $fixture->setDuree(new \DateTimeImmutable('01:15:00'));
        $fixture->setUser($user);

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/seance/');
        self::assertSame(0, $this->seanceRepository->count([]));
    }
}
