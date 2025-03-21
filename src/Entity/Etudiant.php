<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant extends User
{
    

    #[ORM\Column(length: 25)]
    private ?string $matricule = null;

    #[ORM\Column(length: 50)]
    private ?string $tuteur = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Classe $classe = null;


    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getTuteur(): ?string
    {
        return $this->tuteur;
    }

    public function setTuteur(string $tuteur): static
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }
}
