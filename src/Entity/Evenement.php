<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Attestation
 *
 * @ORM\Table(name="attestation", indexes={@ORM\Index(name="Attestation_fk0", columns={"idparticipation"})})
 * @ORM\Entity
 */
#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idEvenement;
   
    #[ORM\Column]
    private ?int $idCat;

    #[ORM\Column(length: 255)]
    private ?string $nomEvenement;

    #[ORM\Column(length: 255)]
    private ?string $description;

    #[ORM\Column(length: 255)]
    private ?string $image;

    #[ORM\Column]
    private ?int $idUtilisateur;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $etatEvenement;

    public function getIdEvenement(): ?int
    {
        return $this->idEvenement;
    }

    public function getIdCat(): ?int
    {
        return $this->idCat;
    }

    public function setIdCat(int $idCat): self
    {
        $this->idCat = $idCat;

        return $this;
    }

    public function getNomEvenement(): ?string
    {
        return $this->nomEvenement;
    }

    public function setNomEvenement(string $nomEvenement): self
    {
        $this->nomEvenement = $nomEvenement;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtatEvenement(): ?string
    {
        return $this->etatEvenement;
    }

    public function setEtatEvenement(string $etatEvenement): self
    {
        $this->etatEvenement = $etatEvenement;

        return $this;
    }


}
