<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity as AcmeAssert;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $commentid;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 10,
        max: 500,
        minMessage: "comment content must be at least {{ limit }} characters long",
        maxMessage: "comment content cannot be longer than {{ limit }} characters",
    )]
    #[AcmeAssert\profanityconstraint]
    private ?string $commentcontent;


    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(name: 'userid', referencedColumnName: 'id')]
    private ?User $user;


    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(name: 'postid', referencedColumnName: 'postid')]
    private ?Post $post;

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

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Post|null
     */
    public function getPost(): ?Post
    {
        return $this->post;
    }

    /**
     * @param Post|null $post
     */
    public function setPost(?Post $post): void
    {
        $this->post = $post;
    }



}
