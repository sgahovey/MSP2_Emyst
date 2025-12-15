<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TableauBordControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $manager = static::getContainer()->get('doctrine')->getManager();

        // Nettoyage des utilisateurs existants pour éviter les doublons
        foreach ($manager->getRepository(User::class)->findAll() as $existingUser) {
            $manager->remove($existingUser);
        }
        $manager->flush();

        // Création d'un utilisateur pour l'authentification
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setName('Test User');
        $user->setPassword('test');
        $manager->persist($user);
        $manager->flush();

        // Connexion automatique de l'utilisateur
        $client->loginUser($user);

        $client->request('GET', '/dashboard');

        self::assertResponseIsSuccessful();
    }
}
