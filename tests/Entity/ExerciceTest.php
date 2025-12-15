<?php

namespace App\Tests\Entity;

use App\Entity\Exercice;
use App\Entity\SeanceExercice;
use PHPUnit\Framework\TestCase;

class ExerciceTest extends TestCase
{
    public function testExerciceCreation(): void
    {
        $exercice = new Exercice();
        
        $this->assertNull($exercice->getId());
        $this->assertNull($exercice->getNom());
        $this->assertNull($exercice->getImageUrl());
        $this->assertNull($exercice->getRepetitions());
        $this->assertNull($exercice->getCharge());
        $this->assertNull($exercice->getDuree());
        $this->assertCount(0, $exercice->getSeanceExercices());
    }

    public function testSetAndGetNom(): void
    {
        $exercice = new Exercice();
        $nom = 'Squat';
        
        $exercice->setNom($nom);
        
        $this->assertSame($nom, $exercice->getNom());
    }

    public function testSetAndGetImageUrl(): void
    {
        $exercice = new Exercice();
        $imageUrl = '/image/squat.jpg';
        
        $exercice->setImageUrl($imageUrl);
        
        $this->assertSame($imageUrl, $exercice->getImageUrl());
    }

    public function testSetImageUrlToNull(): void
    {
        $exercice = new Exercice();
        $exercice->setImageUrl('/image/squat.jpg');
        $this->assertNotNull($exercice->getImageUrl());
        
        $exercice->setImageUrl(null);
        $this->assertNull($exercice->getImageUrl());
    }

    public function testSetAndGetRepetitions(): void
    {
        $exercice = new Exercice();
        $repetitions = 10;
        
        $exercice->setRepetitions($repetitions);
        
        $this->assertSame($repetitions, $exercice->getRepetitions());
    }

    public function testSetAndGetCharge(): void
    {
        $exercice = new Exercice();
        $charge = 50;
        
        $exercice->setCharge($charge);
        
        $this->assertSame($charge, $exercice->getCharge());
    }

    public function testSetChargeToNull(): void
    {
        $exercice = new Exercice();
        $exercice->setCharge(50);
        $this->assertNotNull($exercice->getCharge());
        
        $exercice->setCharge(null);
        $this->assertNull($exercice->getCharge());
    }

    public function testSetAndGetDuree(): void
    {
        $exercice = new Exercice();
        $duree = new \DateTimeImmutable('00:05:00');
        
        $exercice->setDuree($duree);
        
        $this->assertSame($duree, $exercice->getDuree());
    }

    public function testAddAndRemoveSeanceExercice(): void
    {
        $exercice = new Exercice();
        $seanceExercice = $this->createMock(SeanceExercice::class);
        
        // Mock des méthodes nécessaires
        $seanceExercice->method('setExercices')->willReturnSelf();
        $seanceExercice->method('getExercices')->willReturn($exercice);
        
        $this->assertCount(0, $exercice->getSeanceExercices());
        
        $exercice->addSeanceExercice($seanceExercice);
        
        $this->assertCount(1, $exercice->getSeanceExercices());
        $this->assertTrue($exercice->getSeanceExercices()->contains($seanceExercice));
        
        $exercice->removeSeanceExercice($seanceExercice);
        
        $this->assertCount(0, $exercice->getSeanceExercices());
    }

    public function testAddSeanceExerciceTwiceDoesNotDuplicate(): void
    {
        $exercice = new Exercice();
        $seanceExercice = $this->createMock(SeanceExercice::class);
        
        $seanceExercice->method('setExercices')->willReturnSelf();
        $seanceExercice->method('getExercices')->willReturn($exercice);
        
        $exercice->addSeanceExercice($seanceExercice);
        $exercice->addSeanceExercice($seanceExercice);
        
        $this->assertCount(1, $exercice->getSeanceExercices());
    }

    public function testFluentInterface(): void
    {
        $exercice = new Exercice();
        $duree = new \DateTimeImmutable('00:05:00');
        
        $result = $exercice
            ->setNom('Squat')
            ->setImageUrl('/image/squat.jpg')
            ->setRepetitions(10)
            ->setCharge(50)
            ->setDuree($duree);
        
        $this->assertSame($exercice, $result);
        $this->assertSame('Squat', $exercice->getNom());
        $this->assertSame('/image/squat.jpg', $exercice->getImageUrl());
        $this->assertSame(10, $exercice->getRepetitions());
        $this->assertSame(50, $exercice->getCharge());
        $this->assertSame($duree, $exercice->getDuree());
    }
}

