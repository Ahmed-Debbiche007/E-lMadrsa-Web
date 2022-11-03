<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="Participation_fk0", columns={"idUser"}), @ORM\Index(name="Participation_fk1", columns={"idFormation"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idParticipation", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idUser", type="bigint", nullable=true)
     */
    private $iduser;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idFormation", type="bigint", nullable=true)
     */
    private $idformation;

    /**
     * @var float|null
     *
     * @ORM\Column(name="resultat", type="float", precision=10, scale=0, nullable=true)
     */
    private $resultat;

    public function getIdparticipation(): ?string
    {
        return $this->idparticipation;
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

    public function getIdformation(): ?string
    {
        return $this->idformation;
    }

    public function setIdformation(?string $idformation): self
    {
        $this->idformation = $idformation;

        return $this;
    }

    public function getResultat(): ?float
    {
        return $this->resultat;
    }

    public function setResultat(?float $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }


}
