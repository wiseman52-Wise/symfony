<?php

namespace App\Entity;

use App\Repository\EmploisRepository;
use App\Enum\JourSemaine;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmploisRepository::class)]
class Emplois
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $salle = null;

    #[ORM\Column(enumType: JourSemaine::class)]
    private ?JourSemaine $jour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $heure_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $heure_fin = null;

    #[ORM\ManyToOne]
    private ?Cours $cours = null;

    #[ORM\ManyToOne]
    private ?Enseignants $enseignant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(string $salle): static
    {
        $this->salle = $salle;

        return $this;
    }

    public function getJour(): ?JourSemaine
    {
        return $this->jour;
    }

    public function setJour(JourSemaine $jour): static
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHeureDebut(): ?\DateTime
    {
        return $this->heure_debut;
    }

    public function setHeureDebut(\DateTime $heure_debut): static
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    public function getHeureFin(): ?\DateTime
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTime $heure_fin): static
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): static
    {
        $this->cours = $cours;

        return $this;
    }

    public function getEnseignant(): ?Enseignants
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignants $enseignant): static
    {
        $this->enseignant = $enseignant;

        return $this;
    }
}
