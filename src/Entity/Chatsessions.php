<?php

namespace App\Entity;

use App\Repository\ChatSessionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatSessionsRepository::class)]
class Chatsessions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idsession;


    #[ORM\Column]
    private ?int $idtutorshipsession;

    public function getIdsession(): ?int
    {
        return $this->idsession;
    }

    public function getIdtutorshipsession(): ?int
    {
        return $this->idtutorshipsession;
    }

    public function setIdtutorshipsession(int $idtutorshipsession): self
    {
        $this->idtutorshipsession = $idtutorshipsession;

        return $this;
    }


}
