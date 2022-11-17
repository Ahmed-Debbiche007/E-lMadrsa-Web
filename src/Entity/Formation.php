<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idformation;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le Sujet de Formation est obligatoire"),Assert\Length(min: 2,
        max: 50,
        minMessage: 'Le Sujet de Formation doit avoir au moins {{ limit }} characters de Longeur ',
        maxMessage: 'Le Sujet ne peut pas avoir plus que  {{ limit }} characters de Longeur ',)]

        private ?string $sujet;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La description de Formation  est obligatoire")]
    private ?string $description;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La Difficulte de Formation est obligatoire")]
    private ?string $Difficulte;

    #[ORM\Column]
    #[Assert\NotBlank(message: "La Duree est obligatoire"),Assert\GreaterThan(
        value: 4,
        message: 'La Duree d une  Formation doit etre au moins plus de 4 heures !',)]
    private ?int $duree;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(name: 'idprerequis', referencedColumnName: 'idprerequis')]
    #[Assert\NotBlank(message: "Prerequis Formation est obligatoire")]
    private ?Prerequis $prerequis;

    /*#[ORM\Column]
    private ?int $idprerequis;*/



    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(name: 'idcompetence', referencedColumnName: 'idcompetence')]
    #[Assert\NotBlank(message: "Competences Formation est obligatoire")]
    private ?Competences $competences;
    #[ORM\Column]
    private ?int $idcompetence;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(name: 'idexamen', referencedColumnName: 'idexamen')]
    #[Assert\NotBlank(message: "nom de l'examen est obligatoire")]
    private ?Examen $examen;

    /*#[ORM\Column]
    private ?int $idexamen;*/

    #[ORM\Column]
    private ?int $idcategorie;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(name: 'idcategorie', referencedColumnName: 'idcategorie')]
    #[Assert\NotBlank(message: "Categorie Formation  est obligatoire")]
    private ?Categorie $categorie;

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

    public function getDifficulte(): ?string
    {
        return $this->Difficulte;
    }

    public function setDifficulte(string $Difficulte): self
    {
        $this->Difficulte = $Difficulte;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

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
    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }


    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }
    public function getExamen(): ?Examen
    {
        return $this->examen;
    }
    public function setExamen(?Examen $examen): void
    {
        $this->examen = $examen;
    }
    public function getCompetences(): ?Competences
    {
        return $this->competences;
    }


    public function setcompetences(?Competences $competences): void
    {
        $this->competences = $competences;
    }

    public function getPrerequis(): ?Prerequis
    {
        return $this->prerequis;
    }


    public function setPrerequis(?Prerequis $prerequis): void
    {
        $this->prerequis = $prerequis;
    }




    public  function  __toString()
    {
        return (String)$this->sujet ;
    }



}
