<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\Constraints\Date;


#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;
   
    
    

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Veuillez renseigner le champ nomEvenement")]
    private ?string $nomEvenement;

    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Veuillez renseigner le champ description")]
    private ?string $description;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Veuillez renseigner le champ image")]
    private ?string $image;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorieEv $IdCate = null;

 /**
     * @var datetime
     * @Assert\Type(
     *      type = "\DateTime",
     *      message = "vacancy.date.valid",
     * )
     * @Assert\GreaterThanOrEqual(
     *      value = "today")
     * */
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Veuillez renseigner le champ etatEvenement")]
    private ?string $etatEvenement;

   

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idUser = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCate(): ?CategorieEv
    {
        return $this->IdCate;
    }

    public function setIdCate(?CategorieEv $IdCate): self
    {
        $this->IdCate = $IdCate;

        return $this;
    }

    public function getNomEvenement(): ?string
    {
        return $this->nomEvenement;
    }

    public function setNomEvenement(string $nomEvenement): self
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtatEvenement(): ?string
    {
        return $this->etatEvenement;
    }

    public function setEtatEvenement(string $etatEvenement): self
    {
        $this->etatEvenement = $etatEvenement;

        return $this;
    }


}
