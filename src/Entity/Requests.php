<?php

namespace App\Entity;

use App\Repository\RequestsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestsRepository::class)]
class Requests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idrequest;

    #[ORM\Column]
    private ?int $idtutor;

    #[ORM\Column]
    private ?int $idstudent;

    #[ORM\Column(length: 255)]
    private ?string $type;

    #[ORM\Column(length: 255)]
    private ?string $body;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getIdrequest(): ?int
    {
        return $this->idrequest;
    }

    public function getIdtutor(): ?int
    {
        return $this->idtutor;
    }

    public function setIdtutor(int $idtutor): self
    {
        $this->idtutor = $idtutor;

        return $this;
    }

    public function getIdstudent(): ?int
    {
        return $this->idstudent;
    }

    public function setIdstudent(int $idstudent): self
    {
        $this->idstudent = $idstudent;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }



}
