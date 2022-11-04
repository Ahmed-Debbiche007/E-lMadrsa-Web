<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idReservation;

    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateReservation = null;

    #[ORM\Column]
    private ?int $idEvenement;

    #[ORM\Column]
    private ?int $idUtilisateur;

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getIdEvenement(): ?int
    {
        return $this->idEvenement;
    }

    public function setIdEvenement(int $idEvenement): self
    {
        $this->idEvenement = $idEvenement;

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


}
