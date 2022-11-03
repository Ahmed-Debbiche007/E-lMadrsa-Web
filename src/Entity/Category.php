<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="categoryID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryid;

    /**
     * @var string
     *
     * @ORM\Column(name="categoryNAME", type="string", length=255, nullable=false)
     */
    private $categoryname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="categoryIMAGE", type="string", length=255, nullable=true)
     */
    private $categoryimage;

    public function getCategoryid(): ?string
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

    public function setCategoryimage(?string $categoryimage): self
    {
        $this->categoryimage = $categoryimage;

        return $this;
    }


}
