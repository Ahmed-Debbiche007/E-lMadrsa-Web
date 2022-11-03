<?php

namespace App\Entity;
use App\Repository\SessionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionsRepository::class)]
class Chatsessions
{
    #[ORM\Id]
    #[ORM\Column]
    private $idsession;

    #[ORM\Column]
    private $idtutorshipsession;

    public function getIdsession(): ?string
    {
        return $this->idsession;
    }

    public function getIdtutorshipsession(): ?string
    {
        return $this->idtutorshipsession;
    }

    public function setIdtutorshipsession(string $idtutorshipsession): self
    {
        $this->idtutorshipsession = $idtutorshipsession;

        return $this;
    }


}
