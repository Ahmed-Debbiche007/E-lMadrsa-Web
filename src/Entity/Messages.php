<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Repository\MessagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity as AcmeAssert;
#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $idmessage;

    

    #[ORM\Column]
    private ?int $idsender;

    #[Assert\NotBlank]
    #[AcmeAssert\profanityconstraint]
    #[ORM\Column(length: 255)]
    private ?string $body;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $statusdate = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tutorshipsessions $idsession = null;

    public function getIdmessage(): ?int
    {
        return $this->idmessage;
    }

    

    public function getIdsender(): ?int
    {
        return $this->idsender;
    }

    public function setIdsender(int $idsender): self
    {
        $this->idsender = $idsender;

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

    public function getStatusdate(): ?\DateTimeInterface
    {
        return $this->statusdate;
    }

    public function setStatusdate(\DateTimeInterface $statusdate): self
    {
        $this->statusdate = $statusdate;

        return $this;
    }

    public function getIdsession(): ?Tutorshipsessions
    {
        return $this->idsession;
    }

    public function setIdsession(?Tutorshipsessions $idsession): self
    {
        $this->idsession = $idsession;

        return $this;
    }

    public function  __toString()
    {
        return (String)$this->getBody() ;
    }



}
