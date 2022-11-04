<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $commentid;

    #[ORM\Column(length: 255)]
    private ?string $commentcontent;

    #[ORM\Column]
    private ?int $userid;

    #[ORM\Column]
    private ?int $postid;

    #[ORM\Column]
    private ?int $commentvote = 0;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commentdate = null;

    public function getCommentid(): ?int
    {
        return $this->commentid;
    }

    public function getCommentcontent(): ?string
    {
        return $this->commentcontent;
    }

    public function setCommentcontent(string $commentcontent): self
    {
        $this->commentcontent = $commentcontent;

        return $this;
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

    public function getCommentvote(): ?int
    {
        return $this->commentvote;
    }

    public function setCommentvote(int $commentvote): self
    {
        $this->commentvote = $commentvote;

        return $this;
    }

    public function getCommentdate(): ?\DateTimeInterface
    {
        return $this->commentdate;
    }

    public function setCommentdate(\DateTimeInterface $commentdate): self
    {
        $this->commentdate = $commentdate;

        return $this;
    }


}
