<?php

namespace App\Entity;
use App\Repository\AttestationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Attestation
 *
 * @ORM\Table(name="attestation", indexes={@ORM\Index(name="Attestation_fk0", columns={"idparticipation"})})
 * @ORM\Entity
 */
#[ORM\Entity(repositoryClass: AttestationRepository::class)]
class Attestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idattestation;

    #[ORM\Column]
    private ?int $idparticipation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAcq", type="date", nullable=false)
     */
    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datecq = null;

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

    public function getDatecq(): ?\DateTimeInterface
    {
        return $this->datecq;
    }

    public function setDatecq(\DateTimeInterface $datecq): self
    {
        $this->datecq = $datecq;

        return $this;
    }


}
