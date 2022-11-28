<?php
namespace App\Entity;

use App\Repository\TutorshipSessionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TutorshipSessionRepository::class)]
class Tutorshipsessions
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $idsession;

    #[ORM\Column(length: 255)]
    private ?string $url;
    #[ORM\Column(length: 255)]
    private ?string $type;
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne]
    private ?User $idStudent = null;

    #[ORM\ManyToOne(inversedBy: 'tutorshipsessions')]
    private ?User $idTutor = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(onDelete:"SET NULL")]
    private ?Requests $idRequest = null;

    #[ORM\Column(length: 255)]
    private ?string $body = null;

    public function getIdsession(): ?int
    {
        return $this->idsession;
    }




    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getIdTutor(): ?User
    {
        return $this->idTutor;
    }

    public function setIdTutor(?User $idTutor): self
    {
        $this->idTutor = $idTutor;

        return $this;
    }

    public function getIdRequest(): ?Requests
    {
        return $this->idRequest;
    }

    public function setIdRequest(?Requests $idRequest): self
    {
        $this->idRequest = $idRequest;

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
}
