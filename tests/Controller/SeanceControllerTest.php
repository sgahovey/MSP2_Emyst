<?php

namespace App\Tests\Controller;

use App\Entity\Seance;
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

        foreach ($this->seanceRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
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
            'seance[durée]' => 'Testing',
            'seance[user]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->seanceRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Seance();
        $fixture->setDate_entrainement('My Title');
        $fixture->setType_seance('My Title');
        $fixture->setDurée('My Title');
        $fixture->setUser('My Title');

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
        $fixture = new Seance();
        $fixture->setDate_entrainement('Value');
        $fixture->setType_seance('Value');
        $fixture->setDurée('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'seance[date_entrainement]' => 'Something New',
            'seance[type_seance]' => 'Something New',
            'seance[durée]' => 'Something New',
            'seance[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/seance/');

        $fixture = $this->seanceRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate_entrainement());
        self::assertSame('Something New', $fixture[0]->getType_seance());
        self::assertSame('Something New', $fixture[0]->getDurée());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Seance();
        $fixture->setDate_entrainement('Value');
        $fixture->setType_seance('Value');
        $fixture->setDurée('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/seance/');
        self::assertSame(0, $this->seanceRepository->count([]));
    }
}
