<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CaracteristiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaracteristiqueRepository::class)]
#[ApiResource]
class Caracteristique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'caracteristique', targetEntity: CaracteristiqueValeur::class, orphanRemoval: true)]
    private Collection $caracteristiqueValeurs;

    public function __construct()
    {
        $this->caracteristiqueValeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, CaracteristiqueValeur>
     */
    public function getCaracteristiqueValeurs(): Collection
    {
        return $this->caracteristiqueValeurs;
    }

    public function addCaracteristiqueValeur(CaracteristiqueValeur $caracteristiqueValeur): self
    {
        if (!$this->caracteristiqueValeurs->contains($caracteristiqueValeur)) {
            $this->caracteristiqueValeurs[] = $caracteristiqueValeur;
            $caracteristiqueValeur->setCaracteristique($this);
        }

        return $this;
    }

    public function removeCaracteristiqueValeur(CaracteristiqueValeur $caracteristiqueValeur): self
    {
        if ($this->caracteristiqueValeurs->removeElement($caracteristiqueValeur)) {
            // set the owning side to null (unless already changed)
            if ($caracteristiqueValeur->getCaracteristique() === $this) {
                $caracteristiqueValeur->setCaracteristique(null);
            }
        }

        return $this;
    }
}
