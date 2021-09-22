<?php

namespace App\Entity;

use App\Repository\TemoignageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TemoignageRepository::class)
 */
class Temoignage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     */
    private $temoignage;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="temoignages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $temoin;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="temoignages_hebergeur")
     */
    private $hebergeur;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTemoignage(): ?string
    {
        return $this->temoignage;
    }

    public function setTemoignage(string $temoignage): self
    {
        $this->temoignage = $temoignage;

        return $this;
    }

    public function getTemoin(): ?User
    {
        return $this->temoin;
    }

    public function setTemoin(?User $temoin): self
    {
        $this->temoin = $temoin;

        return $this;
    }

    public function getHebergeur(): ?User
    {
        return $this->hebergeur;
    }

    public function setHebergeur(?User $hebergeur): self
    {
        $this->hebergeur = $hebergeur;

        return $this;
    }
}
