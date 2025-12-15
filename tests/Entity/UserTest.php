<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\Seance;
use App\Entity\Objectif;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $user = new User();
        
        $this->assertNull($user->getId());
        $this->assertNull($user->getEmail());
        $this->assertNull($user->getName());
        $this->assertNull($user->getPassword());
        $this->assertNull($user->getTaille());
        $this->assertNull($user->getPoids());
        $this->assertNotNull($user->getDateCreation());
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    public function testSetAndGetEmail(): void
    {
        $user = new User();
        $email = 'test@example.com';
        
        $user->setEmail($email);
        
        $this->assertSame($email, $user->getEmail());
        $this->assertSame($email, $user->getUserIdentifier());
    }

    public function testSetAndGetName(): void
    {
        $user = new User();
        $name = 'John Doe';
        
        $user->setName($name);
        
        $this->assertSame($name, $user->getName());
    }

    public function testSetAndGetPassword(): void
    {
        $user = new User();
        $password = 'hashed_password';
        
        $user->setPassword($password);
        
        $this->assertSame($password, $user->getPassword());
    }

    public function testSetAndGetTaille(): void
    {
        $user = new User();
        $taille = 175.5;
        
        $user->setTaille($taille);
        
        $this->assertSame($taille, $user->getTaille());
    }

    public function testSetAndGetPoids(): void
    {
        $user = new User();
        $poids = 75.5;
        
        $user->setPoids($poids);
        
        $this->assertSame($poids, $user->getPoids());
    }

    public function testRoles(): void
    {
        $user = new User();
        
        // Par défaut, ROLE_USER est présent
        $roles = $user->getRoles();
        $this->assertContains('ROLE_USER', $roles);
        
        // Test avec des rôles personnalisés
        $customRoles = ['ROLE_ADMIN', 'ROLE_USER'];
        $user->setRoles($customRoles);
        
        $roles = $user->getRoles();
        $this->assertContains('ROLE_ADMIN', $roles);
        $this->assertContains('ROLE_USER', $roles);
    }

    public function testAddAndRemoveSeance(): void
    {
        $user = new User();
        $seance = $this->createMock(Seance::class);
        
        // Mock des méthodes nécessaires
        $seance->method('setUser')->willReturnSelf();
        $seance->method('getUser')->willReturn($user);
        
        $this->assertCount(0, $user->getSeances());
        
        $user->addSeance($seance);
        
        $this->assertCount(1, $user->getSeances());
        $this->assertTrue($user->getSeances()->contains($seance));
        
        $user->removeSeance($seance);
        
        $this->assertCount(0, $user->getSeances());
    }

    public function testAddSeanceTwiceDoesNotDuplicate(): void
    {
        $user = new User();
        $seance = $this->createMock(Seance::class);
        
        $seance->method('setUser')->willReturnSelf();
        $seance->method('getUser')->willReturn($user);
        
        $user->addSeance($seance);
        $user->addSeance($seance);
        
        $this->assertCount(1, $user->getSeances());
    }

    public function testAddAndRemoveObjectif(): void
    {
        $user = new User();
        $objectif = $this->createMock(Objectif::class);
        
        // Mock des méthodes nécessaires
        $objectif->method('setUser')->willReturnSelf();
        $objectif->method('getUser')->willReturn($user);
        
        $this->assertCount(0, $user->getObjectifs());
        
        $user->addObjectif($objectif);
        
        $this->assertCount(1, $user->getObjectifs());
        $this->assertTrue($user->getObjectifs()->contains($objectif));
        
        $user->removeObjectif($objectif);
        
        $this->assertCount(0, $user->getObjectifs());
    }

    public function testAddObjectifTwiceDoesNotDuplicate(): void
    {
        $user = new User();
        $objectif = $this->createMock(Objectif::class);
        
        $objectif->method('setUser')->willReturnSelf();
        $objectif->method('getUser')->willReturn($user);
        
        $user->addObjectif($objectif);
        $user->addObjectif($objectif);
        
        $this->assertCount(1, $user->getObjectifs());
    }

    public function testSerialization(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setPassword('original_password');
        
        $serialized = $user->__serialize();
        
        $this->assertIsArray($serialized);
        // Le mot de passe doit être hashé avec crc32c
        $this->assertNotSame('original_password', $serialized["\0App\\Entity\\User\0password"]);
    }
}

