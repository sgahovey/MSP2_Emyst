<?php

namespace App\Entity;

use App\Repository\SeanceExerciceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceExerciceRepository::class)]
class SeanceExercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'seanceExercices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Seance $seances = null;

    #[ORM\ManyToOne(inversedBy: 'seanceExercices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercice $exercices = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\Column]
    private ?int $repetitions = null;

    #[ORM\Column]
    private ?int $charge = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $duree = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeances(): ?Seance
    {
        return $this->seances;
    }

    public function setSeances(?Seance $seances): static
    {
        $this->seances = $seances;

        return $this;
    }

    public function getExercices(): ?Exercice
    {
        return $this->exercices;
    }

    public function setExercices(?Exercice $exercices): static
    {
        $this->exercices = $exercices;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getRepetitions(): ?int
    {
        return $this->repetitions;
    }

    public function setRepetitions(int $repetitions): static
    {
        $this->repetitions = $repetitions;

        return $this;
    }

    public function getCharge(): ?int
    {
        return $this->charge;
    }

    public function setCharge(int $charge): static
    {
        $this->charge = $charge;

        return $this;
    }

    public function getDuree(): ?\DateTimeImmutable
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeImmutable $duree): static
    {
        $this->duree = $duree;

        return $this;
    }
}
