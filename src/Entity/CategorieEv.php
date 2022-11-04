<?php

namespace App\Entity;

use App\Repository\CategorieEvRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieEvRepository::class)]
class CategorieEv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?string $idCat;

    #[ORM\Column(length: 255)]
    private ?string $typeEvenement;

    public function getIdCat(): ?string
    {
        return $this->idCat;
    }

    public function getTypeEvenement(): ?string
    {
        return $this->typeEvenement;
    }

    public function setTypeEvenement(string $typeEvenement): self
    {
        $this->typeEvenement = $typeEvenement;

        return $this;
    }


}
