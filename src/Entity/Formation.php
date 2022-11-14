<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $idformation;

    #[ORM\Column(length: 255)]
    private ?string $sujet;

    #[ORM\Column(length: 255)]
    private ?string $description;

    #[ORM\Column(length: 255)]
    private ?string $difficulté;

    #[ORM\Column]
    private ?int $durée;

    #[ORM\Column]
    private ?int $idprerequis;

    #[ORM\Column]
    private ?int $idcompetence;

    #[ORM\Column]
    private ?int $idexamen;

    #[ORM\Column]
    private ?int $idcategorie;

    public function getIdformation(): ?string
    {
        return $this->idformation;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDifficulté(): ?string
    {
        return $this->difficulté;
    }

    public function setDifficulté(string $difficulté): self
    {
        $this->difficulté = $difficulté;

        return $this;
    }

    public function getDurée(): ?int
    {
        return $this->durée;
    }

    public function setDurée(int $durée): self
    {
        $this->durée = $durée;

        return $this;
    }

    public function getIdprerequis(): ?int
    {
        return $this->idprerequis;
    }

    public function setIdprerequis(int $idprerequis): self
    {
        $this->idprerequis = $idprerequis;

        return $this;
    }

    public function getIdcompetence(): ?int
    {
        return $this->idcompetence;
    }

    public function setIdcompetence(int $idcompetence): self
    {
        $this->idcompetence = $idcompetence;

        return $this;
    }

    public function getIdexamen(): ?int
    {
        return $this->idexamen;
    }

    public function setIdexamen(int $idexamen): self
    {
        $this->idexamen = $idexamen;

        return $this;
    }

    public function getIdcategorie(): ?int
    {
        return $this->idcategorie;
    }

    public function setIdcategorie(int $idcategorie): self
    {
        $this->idcategorie = $idcategorie;

        return $this;
    }

    public function  __toString()
    {
        return (String)$this->sujet ;
    }
}
