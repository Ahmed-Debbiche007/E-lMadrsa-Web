<?php

namespace App\Entity;

use App\Repository\PrerequisRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PrerequisRepository::class)]
class Prerequis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idprerequis;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Le nom de Prerquis est obligatoire"),Assert\Length(min: 2,
        max: 50,
        minMessage: 'Le nom de Prerequis doit avoir au moins {{ limit }} characters de Longeur ',
        maxMessage: 'Le nom de Prerequis ne peut pas avoir plus que  {{ limit }} characters de Longeur ',)]
    private ?string $nomprerequis;

    public function getIdprerequis(): ?int
    {
        return $this->idprerequis;
    }

    public function getNomprerequis(): ?string
    {
        return $this->nomprerequis;
    }

    public function setNomprerequis(string $nomprerequis): self
    {
        $this->nomprerequis = $nomprerequis;

        return $this;
    }
    public  function  __toString()
    {
        return (string)$this->nomprerequis;
    }


}
