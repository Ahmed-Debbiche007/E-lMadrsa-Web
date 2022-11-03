<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Competences
 *
 * @ORM\Table(name="competences")
 * @ORM\Entity
 */
class Competences
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCompetence", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcompetence;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCompetence", type="string", length=255, nullable=false)
     */
    private $nomcompetence;

    public function getIdcompetence(): ?string
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


}
