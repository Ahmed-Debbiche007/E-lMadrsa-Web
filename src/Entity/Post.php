<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $postid;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 10,
        max: 100,
        minMessage: "post title must be at least {{ limit }} characters long",
        maxMessage: "post title cannot be longer than {{ limit }} characters",
    )]
    private ?string $posttitle;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 10,
        max: 500,
        minMessage: "post content must be at least {{ limit }} characters long",
        maxMessage: "post content name cannot be longer than {{ limit }} characters",
    )]
    private ?string $postcontent;


    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(name: 'UserID', referencedColumnName: 'id')]
    private ?User $user;


    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(name: 'categoryid', referencedColumnName: 'categoryid')]
    private ?Category $category;

    #[ORM\Column]
    private ?int $postvote = 0;

    #[ORM\Column]
    private ?int $postnbcom = 0;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $postdate= null ;




    public function getPostid(): ?int
    {
        return $this->postid;
    }

    public function getPosttitle(): ?string
    {
        return $this->posttitle;
    }

    public function setPosttitle(string $posttitle): self
    {
        $this->posttitle = $posttitle;

        return $this;
    }

    public function getPostcontent(): ?string
    {
        return $this->postcontent;
    }

    public function setPostcontent(string $postcontent): self
    {
        $this->postcontent = $postcontent;

        return $this;
    }





    public function getPostvote(): ?int
    {
        return $this->postvote;
    }

    public function setPostvote(int $postvote): self
    {
        $this->postvote = $postvote;

        return $this;
    }

    public function getPostnbcom(): ?int
    {
        return $this->postnbcom;
    }

    public function setPostnbcom(int $postnbcom): self
    {
        $this->postnbcom = $postnbcom;

        return $this;
    }

    public function getPostdate(): ?\DateTimeInterface
    {
        return $this->postdate;
    }

    public function setPostdate(\DateTimeInterface $postdate): self
    {
        $this->postdate = $postdate;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }


    public function setUser(?User $user): void
    {
        $this->user = $user;
    }


    public function getCategory(): ?Category
    {
        return $this->category;
    }


    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }




}
