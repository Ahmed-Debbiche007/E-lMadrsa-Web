<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="vote")
 * @ORM\Entity
 */
class Vote
{
    /**
     * @var int
     *
     * @ORM\Column(name="voteID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $voteid;

    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="bigint", nullable=false)
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
     * @ORM\Column(name="votenb", type="integer", nullable=false)
     */
    private $votenb;

    public function getVoteid(): ?string
    {
        return $this->voteid;
    }

    public function getUserid(): ?string
    {
        return $this->userid;
    }

    public function setUserid(string $userid): self
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
