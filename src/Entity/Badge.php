<?php

namespace App\Entity;

use App\Repository\BadgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
class Badge
{
   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255)]
    private ?string $badgetype;

    #[ORM\Column(length: 255)]
    private ?string $badgeimage;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'badges')]
    private Collection $userid;

    public function __construct()
    {
        $this->userid = new ArrayCollection();
    }

    public function getBadgeid(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, User>
     */
    public function getUserid(): Collection
    {
        return $this->userid;
    }

    public function addUserid(User $userid): self
    {
        if (!$this->userid->contains($userid)) {
            $this->userid->add($userid);
        }

        return $this;
    }

    public function removeUserid(User $userid): self
    {
        $this->userid->removeElement($userid);

        return $this;
    }


}
