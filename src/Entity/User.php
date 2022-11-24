<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $nom = null;

    #[ORM\Column(length: 180)]
    private ?string $prenom = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 180)]
    private ?string $image = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column (length: 255, options: ["default" => "User"])]
    private ?string $role ;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column]
    private ?bool $approved = null;

    #[ORM\OneToMany(mappedBy: 'idTutor', targetEntity: Requests::class)]
    private Collection $requests;

    #[ORM\OneToMany(mappedBy: 'idStudent', targetEntity: Requests::class)]
    private Collection $studentRequest;

    #[ORM\OneToMany(mappedBy: 'idTutor', targetEntity: Tutorshipsessions::class)]
    private Collection $tutorshipsessions;

    public function __construct()
    {
        $this->requests = new ArrayCollection();
        $this->studentRequest = new ArrayCollection();
        $this->tutorshipsessions = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }



    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function isApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function isAdmin() :?bool
    {

        return $this->role == "Admin";

    }

    public function isTutor() :?bool
    {
        return $this->role == "Tutor";

    }

    public function isStudent() :?bool
    {
        return $this->role == "Student";

    }

    public function getPasswordHasherName(): ?string
    {
        if ($this->isAdmin()) {
            return 'harsh';
        }

        return null; // use the default hasher
    }

    /**
     * @return Collection<int, Requests>
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(Requests $request): self
    {
        if (!$this->requests->contains($request)) {
            $this->requests->add($request);
            $request->setIdTutor($this);
        }

        return $this;
    }

    public function removeRequest(Requests $request): self
    {
        if ($this->requests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getIdTutor() === $this) {
                $request->setIdTutor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Requests>
     */
    public function getStudentRequest(): Collection
    {
        return $this->studentRequest;
    }

    public function addStudentRequest(Requests $studentRequest): self
    {
        if (!$this->studentRequest->contains($studentRequest)) {
            $this->studentRequest->add($studentRequest);
            $studentRequest->setIdStudent($this);
        }

        return $this;
    }

    public function removeStudentRequest(Requests $studentRequest): self
    {
        if ($this->studentRequest->removeElement($studentRequest)) {
            // set the owning side to null (unless already changed)
            if ($studentRequest->getIdStudent() === $this) {
                $studentRequest->setIdStudent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tutorshipsessions>
     */
    public function getTutorshipsessions(): Collection
    {
        return $this->tutorshipsessions;
    }

    public function addTutorshipsession(Tutorshipsessions $tutorshipsession): self
    {
        if (!$this->tutorshipsessions->contains($tutorshipsession)) {
            $this->tutorshipsessions->add($tutorshipsession);
            $tutorshipsession->setIdTutor($this);
        }

        return $this;
    }

    public function removeTutorshipsession(Tutorshipsessions $tutorshipsession): self
    {
        if ($this->tutorshipsessions->removeElement($tutorshipsession)) {
            // set the owning side to null (unless already changed)
            if ($tutorshipsession->getIdTutor() === $this) {
                $tutorshipsession->setIdTutor(null);
            }
        }

        return $this;
    }



    public function  __toString()
    {
        return (String)$this->getNom() ;
    }


}