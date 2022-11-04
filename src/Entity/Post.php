<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $postid;

    #[ORM\Column(length: 255)]
    private ?string $posttitle;

    #[ORM\Column(length: 255)]
    private ?string $postcontent;

    #[ORM\Column]
    private ?int $userid;

    #[ORM\Column]
    private ?int $categoryid;

    #[ORM\Column]
    private ?int $postvote = 0;

    #[ORM\Column]
    private ?int $postnbcom = 0;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $postdate ;

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

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getCategoryid(): ?int
    {
        return $this->categoryid;
    }

    public function setCategoryid(int $categoryid): self
    {
        $this->categoryid = $categoryid;

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
    


}
