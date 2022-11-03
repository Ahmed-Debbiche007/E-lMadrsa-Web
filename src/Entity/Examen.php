<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Examen
 *
 * @ORM\Table(name="examen", indexes={@ORM\Index(name="Examen_fk1", columns={"idcategorie"}), @ORM\Index(name="Examen_fk0", columns={"formationId"})})
 * @ORM\Entity
 */
class Examen
{
    /**
     * @var int
     *
     * @ORM\Column(name="idExamen", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexamen;

    /**
     * @var string
     *
     * @ORM\Column(name="nomExamen", type="string", length=255, nullable=false)
     */
    private $nomexamen;

    /**
     * @var float
     *
     * @ORM\Column(name="pourcentage", type="float", precision=10, scale=0, nullable=false)
     */
    private $pourcentage;

    /**
     * @var int
     *
     * @ORM\Column(name="DureeExamen", type="integer", nullable=false)
     */
    private $dureeexamen;

    /**
     * @var int|null
     *
     * @ORM\Column(name="formationId", type="bigint", nullable=true)
     */
    private $formationid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idcategorie", type="bigint", nullable=true)
     */
    private $idcategorie;

    public function getIdexamen(): ?string
    {
        return $this->idexamen;
    }

    public function getNomexamen(): ?string
    {
        return $this->nomexamen;
    }

    public function setNomexamen(string $nomexamen): self
    {
        $this->nomexamen = $nomexamen;

        return $this;
    }

    public function getPourcentage(): ?float
    {
        return $this->pourcentage;
    }

    public function setPourcentage(float $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    public function getDureeexamen(): ?int
    {
        return $this->dureeexamen;
    }

    public function setDureeexamen(int $dureeexamen): self
    {
        $this->dureeexamen = $dureeexamen;

        return $this;
    }

    public function getFormationid(): ?string
    {
        return $this->formationid;
    }

    public function setFormationid(?string $formationid): self
    {
        $this->formationid = $formationid;

        return $this;
    }

    public function getIdcategorie(): ?string
    {
        return $this->idcategorie;
    }

    public function setIdcategorie(?string $idcategorie): self
    {
        $this->idcategorie = $idcategorie;

        return $this;
    }


}
