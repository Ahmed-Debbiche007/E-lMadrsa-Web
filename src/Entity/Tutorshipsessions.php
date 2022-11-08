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
    #[ORM\Column]
    private ?int $idstudent;

    #[ORM\Column]
    private ?int $idtutor;
    #[ORM\Column]
    private ?int $idrequest;
    #[ORM\Column(length: 255)]
    private ?string $url;
    #[ORM\Column(length: 255)]
    private ?string $type;
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getIdsession(): ?int
    {
        return $this->idsession;
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

    public function getIdtutor(): ?int
    {
        return $this->idtutor;
    }

    public function setIdtutor(int $idtutor): self
    {
        $this->idtutor = $idtutor;

        return $this;
    }

    public function getIdrequest(): ?int
    {
        return $this->idrequest;
    }

    public function setIdrequest(int $idrequest): self
    {
        $this->idrequest = $idrequest;

        return $this;
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
}
