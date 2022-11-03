<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation", indexes={@ORM\Index(name="Formation_fk3", columns={"idCategorie"}), @ORM\Index(name="Formation_fk2", columns={"idExamen"}), @ORM\Index(name="Formation_fk0", columns={"idPrerequis"}), @ORM\Index(name="Formation_fk1", columns={"idCompetence"})})
 * @ORM\Entity
 */
class Formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFormation", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idformation;

    /**
     * @var string
     *
     * @ORM\Column(name="Sujet", type="string", length=255, nullable=false)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Difficulté", type="string", length=255, nullable=true)
     */
    private $difficulté;

    /**
     * @var int
     *
     * @ORM\Column(name="durée", type="integer", nullable=false)
     */
    private $durée;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idPrerequis", type="bigint", nullable=true)
     */
    private $idprerequis;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idCompetence", type="bigint", nullable=true)
     */
    private $idcompetence;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idExamen", type="bigint", nullable=true)
     */
    private $idexamen;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idCategorie", type="bigint", nullable=true)
     */
    private $idcategorie;

    public function getIdformation(): ?string
    {
        return $this->idformation;
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

    public function getDifficulté(): ?string
    {
        return $this->difficulté;
    }

    public function setDifficulté(?string $difficulté): self
    {
        $this->difficulté = $difficulté;

        return $this;
    }

    public function getDurée(): ?int
    {
        return $this->durée;
    }

    public function setDurée(int $durée): self
    {
        $this->durée = $durée;

        return $this;
    }

    public function getIdprerequis(): ?string
    {
        return $this->idprerequis;
    }

    public function setIdprerequis(?string $idprerequis): self
    {
        $this->idprerequis = $idprerequis;

        return $this;
    }

    public function getIdcompetence(): ?string
    {
        return $this->idcompetence;
    }

    public function setIdcompetence(?string $idcompetence): self
    {
        $this->idcompetence = $idcompetence;

        return $this;
    }

    public function getIdexamen(): ?string
    {
        return $this->idexamen;
    }

    public function setIdexamen(?string $idexamen): self
    {
        $this->idexamen = $idexamen;

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
