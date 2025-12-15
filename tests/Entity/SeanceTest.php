<?php

namespace App\Tests\Entity;

use App\Entity\Seance;
use App\Entity\User;
use App\Entity\SeanceExercice;
use App\Enum\TypeSeanceEnum;
use PHPUnit\Framework\TestCase;

class SeanceTest extends TestCase
{
    public function testSeanceCreation(): void
    {
        $seance = new Seance();
        
        $this->assertNull($seance->getId());
        $this->assertNull($seance->getDateEntrainement());
        $this->assertNull($seance->getTypeSeance());
        $this->assertNull($seance->getDuree());
        $this->assertNull($seance->getUser());
        $this->assertCount(0, $seance->getSeanceExercices());
    }

    public function testSetAndGetDateEntrainement(): void
    {
        $seance = new Seance();
        $date = new \DateTimeImmutable('2024-12-25');
        
        $seance->setDateEntrainement($date);
        
        $this->assertSame($date, $seance->getDateEntrainement());
    }

    public function testSetAndGetTypeSeance(): void
    {
        $seance = new Seance();
        $type = TypeSeanceEnum::FULL_BODY;
        
        $seance->setTypeSeance($type);
        
        $this->assertSame($type, $seance->getTypeSeance());
    }

    public function testSetAndGetDuree(): void
    {
        $seance = new Seance();
        $duree = new \DateTimeImmutable('01:30:00');
        
        $seance->setDuree($duree);
        
        $this->assertSame($duree, $seance->getDuree());
    }

    public function testSetAndGetUser(): void
    {
        $seance = new Seance();
        $user = new User();
        $user->setEmail('test@example.com');
        
        $seance->setUser($user);
        
        $this->assertSame($user, $seance->getUser());
    }

    public function testAddAndRemoveSeanceExercice(): void
    {
        $seance = new Seance();
        $seanceExercice = $this->createMock(SeanceExercice::class);
        
        // Mock des méthodes nécessaires
        $seanceExercice->method('setSeances')->willReturnSelf();
        $seanceExercice->method('getSeances')->willReturn($seance);
        
        $this->assertCount(0, $seance->getSeanceExercices());
        
        $seance->addSeanceExercice($seanceExercice);
        
        $this->assertCount(1, $seance->getSeanceExercices());
        $this->assertTrue($seance->getSeanceExercices()->contains($seanceExercice));
        
        $seance->removeSeanceExercice($seanceExercice);
        
        $this->assertCount(0, $seance->getSeanceExercices());
    }

    public function testAddSeanceExerciceTwiceDoesNotDuplicate(): void
    {
        $seance = new Seance();
        $seanceExercice = $this->createMock(SeanceExercice::class);
        
        $seanceExercice->method('setSeances')->willReturnSelf();
        $seanceExercice->method('getSeances')->willReturn($seance);
        
        $seance->addSeanceExercice($seanceExercice);
        $seance->addSeanceExercice($seanceExercice);
        
        $this->assertCount(1, $seance->getSeanceExercices());
    }

    public function testFluentInterface(): void
    {
        $seance = new Seance();
        $date = new \DateTimeImmutable('2024-12-25');
        $duree = new \DateTimeImmutable('01:30:00');
        $type = TypeSeanceEnum::CARDIO;
        
        $result = $seance
            ->setDateEntrainement($date)
            ->setTypeSeance($type)
            ->setDuree($duree);
        
        $this->assertSame($seance, $result);
        $this->assertSame($date, $seance->getDateEntrainement());
        $this->assertSame($type, $seance->getTypeSeance());
        $this->assertSame($duree, $seance->getDuree());
    }
}

