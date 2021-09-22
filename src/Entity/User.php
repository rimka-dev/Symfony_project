<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="smallint")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img_avatar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse_user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code_postal;

    /**
     * @ORM\OneToMany(targetEntity=ContactUser::class, mappedBy="sender")
     */
    private $contactUsers;

    /**
     * @ORM\OneToMany(targetEntity=Temoignage::class, mappedBy="temoin")
     */
    private $temoignages;

    /**
     * @ORM\OneToMany(targetEntity=Temoignage::class, mappedBy="hebergeur")
     */
    private $temoignages_hebergeur;

    /**
     * @ORM\OneToMany(targetEntity=ContactUser::class, mappedBy="receveur")
     */
    private $contactUsers_receveur;

    /**
     * @ORM\OneToMany(targetEntity=Annonces::class, mappedBy="user", orphanRemoval=true)
     */
    private $annonces;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    public function __construct()
    {
        $this->contactUsers = new ArrayCollection();
        $this->temoignages = new ArrayCollection();
        $this->temoignages_hebergeur = new ArrayCollection();
        $this->contactUsers_receveur = new ArrayCollection();
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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

    public function getUsername(){}

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getImgAvatar(): ?string
    {
        return $this->img_avatar;
    }

    public function setImgAvatar(?string $img_avatar): self
    {
        $this->img_avatar = $img_avatar;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdresseUser(): ?string
    {
        return $this->adresse_user;
    }

    public function setAdresseUser(?string $adresse_user): self
    {
        $this->adresse_user = $adresse_user;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(?int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    /**
     * @return Collection|ContactUser[]
     */
    public function getContactUsers(): Collection
    {
        return $this->contactUsers;
    }

    public function addContactUser(ContactUser $contactUser): self
    {
        if (!$this->contactUsers->contains($contactUser)) {
            $this->contactUsers[] = $contactUser;
            $contactUser->setSender($this);
        }

        return $this;
    }

    public function removeContactUser(ContactUser $contactUser): self
    {
        if ($this->contactUsers->removeElement($contactUser)) {
            // set the owning side to null (unless already changed)
            if ($contactUser->getSender() === $this) {
                $contactUser->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Temoignage[]
     */
    public function getTemoignages(): Collection
    {
        return $this->temoignages;
    }

    public function addTemoignage(Temoignage $temoignage): self
    {
        if (!$this->temoignages->contains($temoignage)) {
            $this->temoignages[] = $temoignage;
            $temoignage->setTemoin($this);
        }

        return $this;
    }

    public function removeTemoignage(Temoignage $temoignage): self
    {
        if ($this->temoignages->removeElement($temoignage)) {
            // set the owning side to null (unless already changed)
            if ($temoignage->getTemoin() === $this) {
                $temoignage->setTemoin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Temoignage[]
     */
    public function getTemoignagesHebergeur(): Collection
    {
        return $this->temoignages_hebergeur;
    }

    public function addTemoignagesHebergeur(Temoignage $temoignagesHebergeur): self
    {
        if (!$this->temoignages_hebergeur->contains($temoignagesHebergeur)) {
            $this->temoignages_hebergeur[] = $temoignagesHebergeur;
            $temoignagesHebergeur->setHebergeur($this);
        }

        return $this;
    }

    public function removeTemoignagesHebergeur(Temoignage $temoignagesHebergeur): self
    {
        if ($this->temoignages_hebergeur->removeElement($temoignagesHebergeur)) {
            // set the owning side to null (unless already changed)
            if ($temoignagesHebergeur->getHebergeur() === $this) {
                $temoignagesHebergeur->setHebergeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ContactUser[]
     */
    public function getContactUsersReceveur(): Collection
    {
        return $this->contactUsers_receveur;
    }

    public function addContactUsersReceveur(ContactUser $contactUsersReceveur): self
    {
        if (!$this->contactUsers_receveur->contains($contactUsersReceveur)) {
            $this->contactUsers_receveur[] = $contactUsersReceveur;
            $contactUsersReceveur->setReceveur($this);
        }

        return $this;
    }

    public function removeContactUsersReceveur(ContactUser $contactUsersReceveur): self
    {
        if ($this->contactUsers_receveur->removeElement($contactUsersReceveur)) {
            // set the owning side to null (unless already changed)
            if ($contactUsersReceveur->getReceveur() === $this) {
                $contactUsersReceveur->setReceveur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Annonces[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonces $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setUser($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonces $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getUser() === $this) {
                $annonce->setUser(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return '';
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
