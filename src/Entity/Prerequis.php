<?php

namespace App\Entity;

use App\Repository\PrerequisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrerequisRepository::class)]
class Prerequis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idprerequis;

    #[ORM\Column(length: 100)]
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


}
