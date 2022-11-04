<?php

namespace App\Entity;

use App\Repository\VotecommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VotecommentRepository::class)]
class Votecomment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $votecommentid;

    #[ORM\Column]
    private ?int $userid;

    #[ORM\Column]
    private ?int $commentid;

    #[ORM\Column]
    private ?int $votenb;

    public function getVotecommentid(): ?int
    {
        return $this->votecommentid;
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

    public function getCommentid(): ?int
    {
        return $this->commentid;
    }

    public function setCommentid(int $commentid): self
    {
        $this->commentid = $commentid;

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
