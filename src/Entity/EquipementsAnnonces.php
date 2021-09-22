<?php

namespace App\Entity;

use App\Repository\EquipementsAnnoncesRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass=EquipementsAnnoncesRepository::class)
 * @Table(name="equipements_annonces")
 */
class EquipementsAnnonces
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
     * @ORM\ManyToOne(targetEntity=Equipements::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Equipements;

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

    public function getEquipements(): ?Equipements
    {
        return $this->Equipements;
    }

    public function setEquipements(?Equipements $Equipement): self
    {
        $this->Equipements = $Equipement;

        return $this;
    }
}
