<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Competences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idcompetence;

    #[ORM\Column(length: 255)]
    private ?string $nomcompetence;

    public function getIdcompetence(): ?int
    {
        return $this->idcompetence;
    }

    public function getNomcompetence(): ?string
    {
        return $this->nomcompetence;
    }

    public function setNomcompetence(string $nomcompetence): self
    {
        $this->nomcompetence = $nomcompetence;

        return $this;
    }


}
