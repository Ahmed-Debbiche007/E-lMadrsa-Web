<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Prerequis
 *
 * @ORM\Table(name="prerequis")
 * @ORM\Entity
 */
class Prerequis
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPrerequis", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprerequis;

    /**
     * @var string
     *
     * @ORM\Column(name="nomPrerequis", type="string", length=255, nullable=false)
     */
    private $nomprerequis;

    public function getIdprerequis(): ?string
    {
        return $this->idprerequis;
    }

    public function getNomprerequis(): ?string
    {
        return $this->nomprerequis;
    }

    public function setNomprerequis(string $nomprerequis): self
    {
        $this->nomprerequis = $nomprerequis;

        return $this;
    }


}
