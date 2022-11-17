<?php

namespace App\Entity;

use App\Repository\CategorieRepository;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idcategorie;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom de Catégorie est obligatoire"),Assert\Length(min: 2,
        max: 50,
        minMessage: 'Le nom de Catégorie doit avoir au moins {{ limit }} characters de Longeur ',
        maxMessage: 'Le nom de catégorie ne peut pas avoir plus que  {{ limit }} characters de Longeur ',)]

    private ?string $nomcategorie;



    public function getIdcategorie(): ?int
    {
        return $this->idcategorie;
    }

    public function getNomcategorie(): ?string
    {
        return $this->nomcategorie;
    }

    public function setNomcategorie(string $nomcategorie): self
    {
        $this->nomcategorie = $nomcategorie;

        return $this;
    }
    public function  __toString()
    {
        return (String)$this->nomcategorie ;
    }



}
