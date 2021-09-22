<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnoncesRepository::class)
 */
class Annonces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_logement;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_chambre;

    /**
     * @ORM\Column(type="float")
     */
    private $spf_chambre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $chambre_meub;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_sdb;

    /**
     * @ORM\Column(type="float")
     */
    private $superficie;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbr_colocataire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img4;

    /**
     * @ORM\Column(type="boolean")
     */
    private $animaux;

    /**
     * @ORM\Column(type="boolean")
     */
    private $animaux_chat;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $animaux_chien;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $animaux_rongeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $animaux_autres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comp_adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_postal;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pref_genre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fumeur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="annonces")
     * @ORM\JoinTable
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Equipements::class, mappedBy="annonces")
     */
    private $equipements;

    /**
     * @ORM\ManyToMany(targetEntity=Loisirs::class, mappedBy="annonces")
     */
    private $loisirs;

    public function __construct()
    {
        
        $this->equipements = new ArrayCollection();
        $this->loisirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeLogement(): ?string
    {
        return $this->type_logement;
    }

    public function setTypeLogement(string $type_logement): self
    {
        $this->type_logement = $type_logement;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbrChambre(): ?int
    {
        return $this->nbr_chambre;
    }

    public function setNbrChambre(int $nbr_chambre): self
    {
        $this->nbr_chambre = $nbr_chambre;

        return $this;
    }

    public function getSpfChambre(): ?float
    {
        return $this->spf_chambre;
    }

    public function setSpfChambre(float $spf_chambre): self
    {
        $this->spf_chambre = $spf_chambre;

        return $this;
    }

    public function getChambreMeub(): ?bool
    {
        return $this->chambre_meub;
    }

    public function setChambreMeub(bool $chambre_meub): self
    {
        $this->chambre_meub = $chambre_meub;

        return $this;
    }

    public function getNbrSdb(): ?int
    {
        return $this->nbr_sdb;
    }

    public function setNbrSdb(int $nbr_sdb): self
    {
        $this->nbr_sdb = $nbr_sdb;

        return $this;
    }

    public function getSuperficie(): ?float
    {
        return $this->superficie;
    }

    public function setSuperficie(float $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getNbrColocataire(): ?int
    {
        return $this->nbr_colocataire;
    }

    public function setNbrColocataire(int $nbr_colocataire): self
    {
        $this->nbr_colocataire = $nbr_colocataire;

        return $this;
    }

    public function getImg1(): ?string
    {
        return $this->img1;
    }

    public function setImg1(string $img1): self
    {
        $this->img1 = $img1;

        return $this;
    }

    public function getImg2(): ?string
    {
        return $this->img2;
    }

    public function setImg2(?string $img2): self
    {
        $this->img2 = $img2;

        return $this;
    }

    public function getImg3(): ?string
    {
        return $this->img3;
    }

    public function setImg3(?string $img3): self
    {
        $this->img3 = $img3;

        return $this;
    }

    public function getImg4(): ?string
    {
        return $this->img4;
    }

    public function setImg4(?string $img4): self
    {
        $this->img4 = $img4;

        return $this;
    }

    public function getAnimaux(): ?bool
    {
        return $this->animaux;
    }

    public function setAnimaux(bool $animaux): self
    {
        $this->animaux = $animaux;

        return $this;
    }

    public function getAnimauxChat(): ?bool
    {
        return $this->animaux_chat;
    }

    public function setAnimauxChat(bool $animaux_chat): self
    {
        $this->animaux_chat = $animaux_chat;

        return $this;
    }

    public function getAnimauxChien(): ?bool
    {
        return $this->animaux_chien;
    }

    public function setAnimauxChien(?bool $animaux_chien): self
    {
        $this->animaux_chien = $animaux_chien;

        return $this;
    }

    public function getAnimauxRongeur(): ?bool
    {
        return $this->animaux_rongeur;
    }

    public function setAnimauxRongeur(?bool $animaux_rongeur): self
    {
        $this->animaux_rongeur = $animaux_rongeur;

        return $this;
    }

    public function getAnimauxAutres(): ?string
    {
        return $this->animaux_autres;
    }

    public function setAnimauxAutres(?string $animaux_autres): self
    {
        $this->animaux_autres = $animaux_autres;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCompAdresse(): ?string
    {
        return $this->comp_adresse;
    }

    public function setCompAdresse(?string $comp_adresse): self
    {
        $this->comp_adresse = $comp_adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getPrefGenre(): ?string
    {
        return $this->pref_genre;
    }

    public function setPrefGenre(string $pref_genre): self
    {
        $this->pref_genre = $pref_genre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFumeur(): ?bool
    {
        return $this->fumeur;
    }

    public function setFumeur(bool $fumeur): self
    {
        $this->fumeur = $fumeur;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Equipements[]
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipements $equipement): self
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements[] = $equipement;
            $equipement->addAnnonce($this);
        }

        return $this;
    }

    public function removeEquipement(Equipements $equipement): self
    {
        if ($this->equipements->removeElement($equipement)) {
            $equipement->removeAnnonce($this);
        }

        return $this;
    }

    /**
     * @return Collection|Loisirs[]
     */
    public function getLoisirs(): Collection
    {
        return $this->loisirs;
    }

    public function addLoisir(Loisirs $loisir): self
    {
        if (!$this->loisirs->contains($loisir)) {
            $this->loisirs[] = $loisir;
            $loisir->addAnnonce($this);
        }

        return $this;
    }

    public function removeLoisir(Loisirs $loisir): self
    {
        if ($this->loisirs->removeElement($loisir)) {
            $loisir->removeAnnonce($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }
}
