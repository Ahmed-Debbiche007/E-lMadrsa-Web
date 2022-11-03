<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReclamation", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=150, nullable=false)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dateRec", type="date", nullable=true)
     */
    private $daterec;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idUser", type="bigint", nullable=true)
     */
    private $iduser;

    public function getIdreclamation(): ?string
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

    public function setDaterec(?\DateTimeInterface $daterec): self
    {
        $this->daterec = $daterec;

        return $this;
    }

    public function getIduser(): ?string
    {
        return $this->iduser;
    }

    public function setIduser(?string $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }


}
