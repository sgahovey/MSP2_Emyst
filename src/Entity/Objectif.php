<?php

namespace App\Entity;

use App\Enum\TypeObjectifEnum;
use App\Repository\ObjectifRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ObjectifRepository::class)]
class Objectif
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $valeur_cible = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_limite = null;

    #[ORM\Column(enumType: TypeObjectifEnum::class)]
    private ?TypeObjectifEnum $type_objectif = null;

    #[ORM\ManyToOne(inversedBy: 'objectifs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeurCible(): ?int
    {
        return $this->valeur_cible;
    }

    public function setValeurCible(int $valeur_cible): static
    {
        $this->valeur_cible = $valeur_cible;

        return $this;
    }

    public function getDateLimite(): ?\DateTimeImmutable
    {
        return $this->date_limite;
    }

    public function setDateLimite(\DateTimeImmutable $date_limite): static
    {
        $this->date_limite = $date_limite;

        return $this;
    }

    public function getTypeObjectif(): ?TypeObjectifEnum
    {
        return $this->type_objectif;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setTypeObjectif(TypeObjectifEnum $type_objectif): static
    {
        $this->type_objectif = $type_objectif;

        return $this;
    }
}
