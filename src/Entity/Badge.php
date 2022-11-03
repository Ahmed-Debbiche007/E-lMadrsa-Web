<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Badge
 *
 * @ORM\Table(name="badge")
 * @ORM\Entity
 */
class Badge
{
    /**
     * @var int
     *
     * @ORM\Column(name="badgeID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $badgeid;

    /**
     * @var string
     *
     * @ORM\Column(name="badgeTYPE", type="string", length=255, nullable=false)
     */
    private $badgetype;

    /**
     * @var string
     *
     * @ORM\Column(name="badgeIMAGE", type="string", length=255, nullable=false)
     */
    private $badgeimage;

    public function getBadgeid(): ?string
    {
        return $this->badgeid;
    }

    public function getBadgetype(): ?string
    {
        return $this->badgetype;
    }

    public function setBadgetype(string $badgetype): self
    {
        $this->badgetype = $badgetype;

        return $this;
    }

    public function getBadgeimage(): ?string
    {
        return $this->badgeimage;
    }

    public function setBadgeimage(string $badgeimage): self
    {
        $this->badgeimage = $badgeimage;

        return $this;
    }


}
