<?php

namespace App\Entity;

use App\Enum\TypeSeanceEnum;
use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_entrainement = null;

    #[ORM\Column(enumType: TypeSeanceEnum::class)]
    private ?TypeSeanceEnum $type_seance = null;

    #[ORM\Column(name: 'duree', type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $duree = null;

    /**
     * @var Collection<int, SeanceExercice>
     */
    #[ORM\OneToMany(targetEntity: SeanceExercice::class, mappedBy: 'seances')]
    private Collection $seanceExercices;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->seanceExercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntrainement(): ?\DateTimeImmutable
    {
        return $this->date_entrainement;
    }

    public function setDateEntrainement(\DateTimeImmutable $date_entrainement): static
    {
        $this->date_entrainement = $date_entrainement;

        return $this;
    }

    public function getTypeSeance(): ?TypeSeanceEnum
    {
        return $this->type_seance;
    }

    public function setTypeSeance(TypeSeanceEnum $type_seance): static
    {
        $this->type_seance = $type_seance;

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

    /**
     * @return Collection<int, SeanceExercice>
     */
    public function getSeanceExercices(): Collection
    {
        return $this->seanceExercices;
    }

    public function addSeanceExercice(SeanceExercice $seanceExercice): static
    {
        if (!$this->seanceExercices->contains($seanceExercice)) {
            $this->seanceExercices->add($seanceExercice);
            $seanceExercice->setSeances($this);
        }

        return $this;
    }

    public function removeSeanceExercice(SeanceExercice $seanceExercice): static
    {
        if ($this->seanceExercices->removeElement($seanceExercice)) {
            // set the owning side to null (unless already changed)
            if ($seanceExercice->getSeances() === $this) {
                $seanceExercice->setSeances(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
