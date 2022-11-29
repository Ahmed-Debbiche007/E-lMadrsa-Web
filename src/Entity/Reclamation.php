<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idreclamation;

     #[ORM\Column(length: 255)]
     #[Assert\NotBlank(message: "le sujet est obligatoire")]
    private ?string $sujet;

     #[ORM\Column(length: 255)]
     #[Assert\NotBlank(message: "la description est obligatoire")]
     private ?string $description;

    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $daterec = null;

     #[ORM\ManyToOne(inversedBy: 'reclamations')]
    #[ORM\JoinColumn(name: 'idUser', referencedColumnName: 'id')]
    #[Assert\NotBlank(message: "l'utilisateur est obligatoire")]
    private ?User $iduser;

    public function getIdreclamation(): ?int
    {
        return $this->idreclamation;
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

    public function getDaterec(): ?\DateTimeInterface
    {
        return $this->daterec;
    }

    public function setDaterec(\DateTimeInterface $daterec): self
    {
        $this->daterec = $daterec;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(User $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }


}
