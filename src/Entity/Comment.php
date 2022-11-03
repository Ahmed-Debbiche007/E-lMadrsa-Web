<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="CommentID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commentid;

    /**
     * @var string
     *
     * @ORM\Column(name="CommentCONTENT", type="text", length=65535, nullable=false)
     */
    private $commentcontent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="userID", type="bigint", nullable=true)
     */
    private $userid;

    /**
     * @var int
     *
     * @ORM\Column(name="postID", type="bigint", nullable=false)
     */
    private $postid;

    /**
     * @var int
     *
     * @ORM\Column(name="commentVOTE", type="integer", nullable=false)
     */
    private $commentvote = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="commentDATE", type="datetime", nullable=false)
     */
    private $commentdate;

    public function getCommentid(): ?string
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

    public function getUserid(): ?string
    {
        return $this->userid;
    }

    public function setUserid(?string $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getPostid(): ?string
    {
        return $this->postid;
    }

    public function setPostid(string $postid): self
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
