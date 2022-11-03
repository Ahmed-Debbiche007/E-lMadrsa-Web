<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="postID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postid;

    /**
     * @var string
     *
     * @ORM\Column(name="postTITLE", type="string", length=255, nullable=false)
     */
    private $posttitle;

    /**
     * @var string
     *
     * @ORM\Column(name="postCONTENT", type="text", length=65535, nullable=false)
     */
    private $postcontent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="userID", type="bigint", nullable=true)
     */
    private $userid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="categoryID", type="bigint", nullable=true)
     */
    private $categoryid;

    /**
     * @var int
     *
     * @ORM\Column(name="postVOTE", type="integer", nullable=false)
     */
    private $postvote = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="postNBCOM", type="integer", nullable=false)
     */
    private $postnbcom = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postDATE", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $postdate = 'CURRENT_TIMESTAMP';

    public function getPostid(): ?string
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

    public function getUserid(): ?string
    {
        return $this->userid;
    }

    public function setUserid(?string $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getCategoryid(): ?string
    {
        return $this->categoryid;
    }

    public function setCategoryid(?string $categoryid): self
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
