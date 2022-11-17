<?php

namespace App\Entity;
use App\Repository\AttestationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use http\Message;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AttestationRepository::class)]
class Attestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idattestation;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Le champ idParticipation  est obligatoire")]
    private ?int $idparticipation;

    #[ORM\ManyToOne(inversedBy: 'attestations')]
    #[ORM\JoinColumn(name: 'idparticipation', referencedColumnName: 'idparticipation')]
    //#[ORM\JoinColumn(onDelete: "CASCADE",name: 'classroom_ref',referencedColumnName: 'ref')]
    private ?Participation $participation;


    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\LessThanOrEqual("today",message: 'le date doit etre égal ou infèrieur à aujourd hui')]
    private ? \DateTimeInterface $dateAcq= null;

    public function getIdattestation(): ?int
    {
        return $this->idattestation;
    }

    public function getIdparticipation(): ?int
    {
        return $this->idparticipation;
    }

    public function setIdparticipation(int $idparticipation): self
    {
        $this->idparticipation = $idparticipation;

        return $this;
    }

    public function getdateAcq(): ? \DateTimeInterface
    {
        return $this->dateAcq;
    }

    public function setdateAcq(\DateTimeInterface $dateAcq	): self
    {
        $this->dateAcq= $dateAcq	;

        return $this;
    }


    public function getParticipation(): ?Participation
    {
        return $this->participation;
    }


    public function setParticipation(?Participation $participation): void
    {
        $this->participation = $participation;
    }
    public function getUser(): ?User
    {
        return $this->participation.$this->getUser();
    }


    public function setUser(?User $user): void
    {
        $this->user = $user;
    }








}
