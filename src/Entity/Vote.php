<?php

namespace App\Entity;
use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $voteid;

    #[ORM\Column]
    private ?int $userid;

    #[ORM\Column]
    private ?int $postid;

    #[ORM\Column]
    private ?int $votenb;

    public function getVoteid(): ?int
    {
        return $this->voteid;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getPostid(): ?int
    {
        return $this->postid;
    }

    public function setPostid(int $postid): self
    {
        $this->postid = $postid;

        return $this;
    }

    public function getVotenb(): ?int
    {
        return $this->votenb;
    }

    public function setVotenb(int $votenb): self
    {
        $this->votenb = $votenb;

        return $this;
    }


}
