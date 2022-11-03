<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recup
 *
 * @ORM\Table(name="recup")
 * @ORM\Entity
 */
class Recup
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="bigint", nullable=false)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=15, nullable=false)
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIduser(): ?string
    {
        return $this->iduser;
    }

    public function setIduser(string $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }


}
