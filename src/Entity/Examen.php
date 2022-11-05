<?php

namespace App\Entity;

use App\Repository\ExamenRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExamenRepository::class)]
class Examen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $idexamen;

    #[ORM\Column(length: 255)]
    private ?string $nomexamen;

    #[ORM\Column]
    private ?float $pourcentage;

    #[ORM\Column]
    private ?int $dureeexamen;

    #[ORM\ManyToOne(inversedBy: 'examens')]
    #[ORM\JoinColumn(name: 'formationid', referencedColumnName: 'idformation')]
    private ?Formation $formation;

    #[ORM\ManyToOne(inversedBy: 'examens')]
    #[ORM\JoinColumn(name: 'idcategorie', referencedColumnName: 'idcategorie')]
    private ?Categorie $categorie;

    public function getIdexamen(): ?string
    {
        return $this->idexamen;
    }

    public function getNomexamen(): ?string
    {
        return $this->nomexamen;
    }

    public function setNomexamen(string $nomexamen): self
    {
        $this->nomexamen = $nomexamen;

        return $this;
    }

    public function getPourcentage(): ?float
    {
        return $this->pourcentage;
    }

    public function setPourcentage(float $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getDureeexamen(): ?int
    {
        return $this->dureeexamen;
    }

    public function setDureeexamen(int $dureeexamen): self
    {
        $this->dureeexamen = $dureeexamen;

        return $this;
    }


    public function getFormation(): ?Formation
    {
        return $this->formation;
    }


    public function setFormation(?Formation $formation): void
    {
        $this->formation = $formation;
    }


    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }


    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }





    public function  __toString()
    {
        return (String)$this->nomexamen ;
    }

}
