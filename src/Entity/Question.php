<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idquestion;

   #[ORM\Column(length: 255)]
    private ?string $ennonce;

   #[ORM\Column(length: 255)]
    private ?string $option1;

   #[ORM\Column(length: 255)]
    private ?string $option2;

   #[ORM\Column(length: 255)]
    private ?string $option3;

   #[ORM\Column(length: 255)]
    private ?string $answer;
    
    #[ORM\Column]
    private ?int $idexamen;

    public function getIdquestion(): ?int
    {
        return $this->idquestion;
    }

    public function getEnnonce(): ?string
    {
        return $this->ennonce;
    }

    public function setEnnonce(string $ennonce): self
    {
        $this->ennonce = $ennonce;

        return $this;
    }

    public function getOption1(): ?string
    {
        return $this->option1;
    }

    public function setOption1(string $option1): self
    {
        $this->option1 = $option1;

        return $this;
    }

    public function getOption2(): ?string
    {
        return $this->option2;
    }

    public function setOption2(string $option2): self
    {
        $this->option2 = $option2;

        return $this;
    }

    public function getOption3(): ?string
    {
        return $this->option3;
    }

    public function setOption3(string $option3): self
    {
        $this->option3 = $option3;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getIdexamen(): ?int
    {
        return $this->idexamen;
    }

    public function setIdexamen(int $idexamen): self
    {
        $this->idexamen = $idexamen;

        return $this;
    }


}
