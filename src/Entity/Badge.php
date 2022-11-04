<?php

namespace App\Entity;

use App\Repository\BadgeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
class Badge
{
   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $badgeid;

    #[ORM\Column(length: 255)]
    private ?string $badgetype;

    #[ORM\Column(length: 255)]
    private ?string $badgeimage;

    public function getBadgeid(): ?int
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
