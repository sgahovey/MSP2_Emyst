<?php

namespace App\Tests\Entity;

use App\Entity\Objectif;
use App\Entity\User;
use App\Enum\TypeObjectifEnum;
use PHPUnit\Framework\TestCase;

class ObjectifTest extends TestCase
{
    public function testObjectifCreation(): void
    {
        $objectif = new Objectif();
        
        $this->assertNull($objectif->getId());
        $this->assertNull($objectif->getValeurCible());
        $this->assertNull($objectif->getDateLimite());
        $this->assertNull($objectif->getTypeObjectif());
        $this->assertNull($objectif->getUser());
    }

    public function testSetAndGetValeurCible(): void
    {
        $objectif = new Objectif();
        $valeur = 100;
        
        $objectif->setValeurCible($valeur);
        
        $this->assertSame($valeur, $objectif->getValeurCible());
    }

    public function testSetAndGetDateLimite(): void
    {
        $objectif = new Objectif();
        $date = new \DateTimeImmutable('2030-12-31');
        
        $objectif->setDateLimite($date);
        
        $this->assertSame($date, $objectif->getDateLimite());
    }

    public function testSetAndGetTypeObjectif(): void
    {
        $objectif = new Objectif();
        $type = TypeObjectifEnum::PERTE_POIDS;
        
        $objectif->setTypeObjectif($type);
        
        $this->assertSame($type, $objectif->getTypeObjectif());
    }

    public function testSetAndGetUser(): void
    {
        $objectif = new Objectif();
        $user = new User();
        $user->setEmail('test@example.com');
        
        $objectif->setUser($user);
        
        $this->assertSame($user, $objectif->getUser());
    }

    public function testSetUserToNull(): void
    {
        $objectif = new Objectif();
        $user = new User();
        $user->setEmail('test@example.com');
        
        $objectif->setUser($user);
        $this->assertSame($user, $objectif->getUser());
        
        $objectif->setUser(null);
        $this->assertNull($objectif->getUser());
    }

    public function testFluentInterface(): void
    {
        $objectif = new Objectif();
        $date = new \DateTimeImmutable('2030-12-31');
        $type = TypeObjectifEnum::AUGMENTATION_FORCE;
        
        $result = $objectif
            ->setValeurCible(50)
            ->setDateLimite($date)
            ->setTypeObjectif($type);
        
        $this->assertSame($objectif, $result);
        $this->assertSame(50, $objectif->getValeurCible());
        $this->assertSame($date, $objectif->getDateLimite());
        $this->assertSame($type, $objectif->getTypeObjectif());
    }
}

