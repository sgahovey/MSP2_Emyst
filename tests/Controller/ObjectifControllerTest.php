<?php

namespace App\Tests\Controller;

use App\Entity\Objectif;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ObjectifControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $objectifRepository;
    private string $path = '/objectif/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->objectifRepository = $this->manager->getRepository(Objectif::class);

        foreach ($this->objectifRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Objectif index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'objectif[valeur_cible]' => 'Testing',
            'objectif[date_limite]' => 'Testing',
            'objectif[type_objectif]' => 'Testing',
            'objectif[user]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->objectifRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Objectif();
        $fixture->setValeur_cible('My Title');
        $fixture->setDate_limite('My Title');
        $fixture->setType_objectif('My Title');
        $fixture->setUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Objectif');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Objectif();
        $fixture->setValeur_cible('Value');
        $fixture->setDate_limite('Value');
        $fixture->setType_objectif('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'objectif[valeur_cible]' => 'Something New',
            'objectif[date_limite]' => 'Something New',
            'objectif[type_objectif]' => 'Something New',
            'objectif[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/objectif/');

        $fixture = $this->objectifRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getValeur_cible());
        self::assertSame('Something New', $fixture[0]->getDate_limite());
        self::assertSame('Something New', $fixture[0]->getType_objectif());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Objectif();
        $fixture->setValeur_cible('Value');
        $fixture->setDate_limite('Value');
        $fixture->setType_objectif('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/objectif/');
        self::assertSame(0, $this->objectifRepository->count([]));
    }
}
