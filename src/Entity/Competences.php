<?php

namespace App\Entity;

use App\Repository\CompetencesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CompetencesRepository::class)]
class Competences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idcompetence;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom de Compétence est obligatoire"),Assert\Length(min: 2,
        max: 50,
        minMessage: 'Le nom de Compétence doit avoir au moins {{ limit }} characters de Longeur ',
        maxMessage: 'Le nom de compétence ne peut pas avoir plus que  {{ limit }} characters de Longeur ',)]
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
    public function  __toString()
    {
        return (String)$this->nomcompetence ;
    }



}
