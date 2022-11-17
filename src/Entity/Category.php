<?php

namespace App\Entity;
use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity as AcmeAssert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $categoryid;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/\d/',
        match: false,
        message: "Your name cannot contain a number",
    )]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Your first name must be at least {{ limit }} characters long",
        maxMessage: "Your first name cannot be longer than {{ limit }} characters",
    )]
    #[AcmeAssert\profanityconstraint]
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

    // public function __toString(){
    //     return (string) $this->categoryname;
    // }
}
