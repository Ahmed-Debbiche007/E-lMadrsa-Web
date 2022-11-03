<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Attestation
 *
 * @ORM\Table(name="attestation", indexes={@ORM\Index(name="Attestation_fk0", columns={"idparticipation"})})
 * @ORM\Entity
 */
class Attestation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAttestation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idattestation;

    /**
     * @var int
     *
     * @ORM\Column(name="idparticipation", type="integer", nullable=false)
     */
    private $idparticipation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAcq", type="date", nullable=false)
     */
    private $dateacq;

    public function getIdattestation(): ?int
    {
        return $this->idattestation;
    }

    public function getIdparticipation(): ?int
    {
        return $this->idparticipation;
    }

    public function setIdparticipation(int $idparticipation): self
    {
        $this->idparticipation = $idparticipation;

        return $this;
    }

    public function getDateacq(): ?\DateTimeInterface
    {
        return $this->dateacq;
    }

    public function setDateacq(\DateTimeInterface $dateacq): self
    {
        $this->dateacq = $dateacq;

        return $this;
    }


}
