<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\NotBlank(message: "l'utilisateur est obligatoire")]

    //#[ORM\JoinColumn(onDelete: "CASCADE",name: 'classroom_ref',referencedColumnName: 'ref')]
    private ?User $user;

    #[ORM\ManyToOne(inversedBy: 'participations')]
    #[ORM\JoinColumn(name: 'idformation', referencedColumnName: 'idformation')]

    #[Assert\NotBlank(message: "la formation est obligatoire")]
    //#[ORM\JoinColumn(onDelete: "CASCADE",name: 'classroom_ref',referencedColumnName: 'ref')]
    private ?Formation $formation;

    #[ORM\Column]
    private ?int $iduser;

    #[ORM\Column]
    private ?int $idformation;




    #[ORM\Column]
    #[Assert\Positive(message: "la résultat doit être positif ")]
    #[Assert\NotBlank(message: "la résultat est obligatoire")]
    private ?float $resultat;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datePart = null;



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

    /**
     * @return \DateTimeInterface|null
     */
    public function getDatePart(): ?\DateTimeInterface
    {
        return $this->datePart;
    }

    /**
     * @param \DateTimeInterface|null $datePart
     */
    public function setDatePart(?\DateTimeInterface $datePart): void
    {
        $this->datePart = $datePart;
    }



    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getIdformation(): ?int
    {
        return $this->idformation;
    }

    public function setIdformation(int $idformation): self
    {
        $this->idformation = $idformation;

        return $this;
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




    public function  __toString()
    {
        return (String)$this->idparticipation ;
    }

}
