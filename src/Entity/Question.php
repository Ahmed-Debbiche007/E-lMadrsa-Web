<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idquestion;

   #[ORM\Column(length: 500)]
   #[Assert\NotBlank(message: "l'ennonce du question est obligatoire")]

   private ?string $ennonce;

   #[ORM\Column(length: 500)]
   #[Assert\NotBlank(message: "l'option 1 du question est obligatoire")]
    private ?string $option1;

   #[ORM\Column(length: 500)]
   #[Assert\NotBlank(message: "l'option 2 du question est obligatoire")]
    private ?string $option2;

   #[ORM\Column(length: 500)]
   #[Assert\NotBlank(message: "l'option 3 du question est obligatoire")]
    private ?string $option3;

   #[ORM\Column(length: 500)]
   #[Assert\NotBlank(message: "la réponse du question est obligatoire")]
    private ?string $answer;
    

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(name: 'idexamen', referencedColumnName: 'idexamen')]
    #[Assert\NotBlank(message: "l'examen est obligatoire")]
    //#[ORM\JoinColumn(onDelete: "CASCADE",name: 'classroom_ref',referencedColumnName: 'ref')]
    private ?Examen $examen;

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


    public function getExamen(): ?Examen
    {
        return $this->examen;
    }


    public function setExamen(?Examen $examen): void
    {
        $this->examen = $examen;
    }




}
