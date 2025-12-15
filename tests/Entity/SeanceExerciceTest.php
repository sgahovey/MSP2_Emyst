<?php

namespace App\Tests\Entity;

use App\Entity\SeanceExercice;
use App\Entity\Seance;
use App\Entity\Exercice;
use PHPUnit\Framework\TestCase;

class SeanceExerciceTest extends TestCase
{
    public function testSeanceExerciceCreation(): void
    {
        $seanceExercice = new SeanceExercice();
        
        $this->assertNull($seanceExercice->getId());
        $this->assertNull($seanceExercice->getSeances());
        $this->assertNull($seanceExercice->getExercices());
        $this->assertNull($seanceExercice->getOrdre());
        $this->assertNull($seanceExercice->getRepetitions());
        $this->assertNull($seanceExercice->getCharge());
        $this->assertNull($seanceExercice->getDuree());
    }

    public function testSetAndGetSeances(): void
    {
        $seanceExercice = new SeanceExercice();
        $seance = new Seance();
        
        $seanceExercice->setSeances($seance);
        
        $this->assertSame($seance, $seanceExercice->getSeances());
    }

    public function testSetSeancesToNull(): void
    {
        $seanceExercice = new SeanceExercice();
        $seance = new Seance();
        
        $seanceExercice->setSeances($seance);
        $this->assertSame($seance, $seanceExercice->getSeances());
        
        $seanceExercice->setSeances(null);
        $this->assertNull($seanceExercice->getSeances());
    }

    public function testSetAndGetExercices(): void
    {
        $seanceExercice = new SeanceExercice();
        $exercice = new Exercice();
        $exercice->setNom('Squat');
        
        $seanceExercice->setExercices($exercice);
        
        $this->assertSame($exercice, $seanceExercice->getExercices());
    }

    public function testSetExercicesToNull(): void
    {
        $seanceExercice = new SeanceExercice();
        $exercice = new Exercice();
        $exercice->setNom('Squat');
        
        $seanceExercice->setExercices($exercice);
        $this->assertSame($exercice, $seanceExercice->getExercices());
        
        $seanceExercice->setExercices(null);
        $this->assertNull($seanceExercice->getExercices());
    }

    public function testSetAndGetOrdre(): void
    {
        $seanceExercice = new SeanceExercice();
        $ordre = 1;
        
        $seanceExercice->setOrdre($ordre);
        
        $this->assertSame($ordre, $seanceExercice->getOrdre());
    }

    public function testSetAndGetRepetitions(): void
    {
        $seanceExercice = new SeanceExercice();
        $repetitions = 12;
        
        $seanceExercice->setRepetitions($repetitions);
        
        $this->assertSame($repetitions, $seanceExercice->getRepetitions());
    }

    public function testSetAndGetCharge(): void
    {
        $seanceExercice = new SeanceExercice();
        $charge = 80;
        
        $seanceExercice->setCharge($charge);
        
        $this->assertSame($charge, $seanceExercice->getCharge());
    }

    public function testSetAndGetDuree(): void
    {
        $seanceExercice = new SeanceExercice();
        $duree = new \DateTimeImmutable('00:03:00');
        
        $seanceExercice->setDuree($duree);
        
        $this->assertSame($duree, $seanceExercice->getDuree());
    }

    public function testFluentInterface(): void
    {
        $seanceExercice = new SeanceExercice();
        $seance = new Seance();
        $exercice = new Exercice();
        $duree = new \DateTimeImmutable('00:03:00');
        
        $result = $seanceExercice
            ->setSeances($seance)
            ->setExercices($exercice)
            ->setOrdre(1)
            ->setRepetitions(12)
            ->setCharge(80)
            ->setDuree($duree);
        
        $this->assertSame($seanceExercice, $result);
        $this->assertSame($seance, $seanceExercice->getSeances());
        $this->assertSame($exercice, $seanceExercice->getExercices());
        $this->assertSame(1, $seanceExercice->getOrdre());
        $this->assertSame(12, $seanceExercice->getRepetitions());
        $this->assertSame(80, $seanceExercice->getCharge());
        $this->assertSame($duree, $seanceExercice->getDuree());
    }
}

