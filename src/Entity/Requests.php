<?php
namespace App\Entity;

use App\Repository\RequestsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RequestsRepository::class)]
class Requests
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id;

    

  

    #[ORM\Column(length: 255)]
    private ?string $type;

    #[ORM\Column(length: 255)]
    private ?string $body;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'requests')]
    private ?User $idTutor = null;

    #[ORM\ManyToOne(inversedBy: 'studentRequest')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idStudent = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdTutor(): ?User
    {
        return $this->idTutor;
    }

    public function setIdTutor(?User $idTutor): self
    {
        $this->idTutor = $idTutor;

        return $this;
    }

    public function getIdStudent(): ?User
    {
        return $this->idStudent;
    }

    public function setIdStudent(?User $idStudent): self
    {
        $this->idStudent = $idStudent;

        return $this;
    }


}
