<?php

namespace App\Entity;

use App\Repository\LoisirsAnnoncesRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass=LoisirsAnnoncesRepository::class)
 * @Table(name="loisirs_annonces")
 */
class LoisirsAnnonces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Annonces::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Annonces;

    /**
     * @ORM\ManyToOne(targetEntity=Loisirs::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Loisirs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnonces(): ?Annonces
    {
        return $this->Annonces;
    }

    public function setAnnonces(?Annonces $Annonce): self
    {
        $this->Annonces = $Annonce;

        return $this;
    }

    public function getLoisirs(): ?Loisirs
    {
        return $this->Loisirs;
    }

    public function setLoisirs(?Loisirs $Loisir): self
    {
        $this->Loisirs = $Loisir;

        return $this;
    }
}
