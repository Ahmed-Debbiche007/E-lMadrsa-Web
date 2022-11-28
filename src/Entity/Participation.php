<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Form;

#[ORM\Entity(repositoryClass: ParticipationRepository::class)]
class Participation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idparticipation;

    #[ORM\ManyToOne(inversedBy: 'participations')]
    #[ORM\JoinColumn(name: 'idUser', referencedColumnName: 'id')]
    //#[ORM\JoinColumn(onDelete: "CASCADE",name: 'classroom_ref',referencedColumnName: 'ref')]
    private ?User $user;

    #[ORM\ManyToOne(inversedBy: 'participations')]
    #[ORM\JoinColumn(name: 'idformation', referencedColumnName: 'idformation')]
    //#[ORM\JoinColumn(onDelete: "CASCADE",name: 'classroom_ref',referencedColumnName: 'ref')]
    private ?Formation $formation;

    #[ORM\Column]
    private ?float $resultat;

    public function getIdparticipation(): ?int
    {
        return $this->idparticipation;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }


    public function setUser(?User $user): void
    {
        $this->user = $user;
    }


    public function getFormation(): ?Formation
    {
        return $this->formation;
    }


    public function setFormation(?Formation $formation): void
    {
        $this->formation = $formation;
    }






    public function getResultat(): ?float
    {
        return $this->resultat;
    }

    public function setResultat(float $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }


}
