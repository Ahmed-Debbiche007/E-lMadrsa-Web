<?php
namespace App\Entity;

use App\Repository\TutorshipSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity as AcmeAssert;

#[ORM\Entity(repositoryClass: TutorshipSessionRepository::class)]
class Tutorshipsessions
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id;

    #[ORM\Column(length: 255)]
    private ?string $url;
    #[ORM\Column(length: 255)]
    private ?string $type;

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

    #[ORM\ManyToOne]
    private ?User $idStudent = null;

    #[ORM\ManyToOne(inversedBy: 'tutorshipsessions')]
    private ?User $idTutor = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(onDelete:"SET NULL")]
    private ?Requests $idRequest = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 10,
        max: 100,
        minMessage: "Session body must be at least {{ limit }} characters long",
        maxMessage: "Session body cannot be longer than {{ limit }} characters",
    )]
    #[AcmeAssert\profanityconstraint]
    private ?string $body = null;

    #[ORM\OneToMany(mappedBy: 'idsession', targetEntity: Messages::class, orphanRemoval: true)]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getIdsession(): ?int
    {
        return $this->id;
    }




    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getIdStudent(): ?User
    {
        return $this->idStudent;
    }

    public function setIdStudent(?User $idStudent): self
    {
        $this->idStudent = $idStudent;

        return $this;
    }

    public function getIdTutor(): ?User
    {
        return $this->idTutor;
    }

    public function setIdTutor(?User $idTutor): self
    {
        $this->idTutor = $idTutor;

        return $this;
    }

    public function getIdRequest(): ?Requests
    {
        return $this->idRequest;
    }

    public function setIdRequest(?Requests $idRequest): self
    {
        $this->idRequest = $idRequest;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setIdsession($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getIdsession() === $this) {
                $message->setIdsession(null);
            }
        }

        return $this;
    }
}
