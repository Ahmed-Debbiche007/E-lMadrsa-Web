<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question", indexes={@ORM\Index(name="Question_fk0", columns={"idExamen"})})
 * @ORM\Entity
 */
class Question
{
    /**
     * @var int
     *
     * @ORM\Column(name="idQuestion", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idquestion;

    /**
     * @var string
     *
     * @ORM\Column(name="ennonce", type="string", length=500, nullable=false)
     */
    private $ennonce;

    /**
     * @var string
     *
     * @ORM\Column(name="option1", type="string", length=500, nullable=false)
     */
    private $option1;

    /**
     * @var string
     *
     * @ORM\Column(name="option2", type="string", length=500, nullable=false)
     */
    private $option2;

    /**
     * @var string
     *
     * @ORM\Column(name="option3", type="string", length=500, nullable=false)
     */
    private $option3;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=500, nullable=false)
     */
    private $answer;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idExamen", type="bigint", nullable=true)
     */
    private $idexamen;

    public function getIdquestion(): ?string
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

    public function getIdexamen(): ?string
    {
        return $this->idexamen;
    }

    public function setIdexamen(?string $idexamen): self
    {
        $this->idexamen = $idexamen;

        return $this;
    }


}
