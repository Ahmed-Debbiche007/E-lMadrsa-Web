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

    #[ORM\Column]
    private ?int $formationid;

    #[ORM\Column]
    private ?int $idcategorie;

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

    public function getFormationid(): ?int
    {
        return $this->formationid;
    }

    public function setFormationid(int $formationid): self
    {
        $this->formationid = $formationid;

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


}
