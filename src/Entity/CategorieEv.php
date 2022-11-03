<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieEv
 *
 * @ORM\Table(name="categorie_ev")
 * @ORM\Entity
 */
class CategorieEv
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_Cat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCat;

    /**
     * @var string
     *
     * @ORM\Column(name="type_evenement", type="string", length=255, nullable=false)
     */
    private $typeEvenement;

    public function getIdCat(): ?int
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
