<?php

namespace App\Entity;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $categoryid;

    #[ORM\Column(length: 255)]
    private ?string $categoryname;

    #[ORM\Column(length: 255)]
    private ?string $categoryimage;

    public function getCategoryid(): ?int
    {
        return $this->categoryid;
    }

    public function getCategoryname(): ?string
    {
        return $this->categoryname;
    }

    public function setCategoryname(string $categoryname): self
    {
        $this->categoryname = $categoryname;

        return $this;
    }

    public function getCategoryimage(): ?string
    {
        return $this->categoryimage;
    }

    public function setCategoryimage(string $categoryimage): self
    {
        $this->categoryimage = $categoryimage;

        return $this;
    }


}
