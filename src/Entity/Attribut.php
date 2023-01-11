<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AttributRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributRepository::class)]
#[ApiResource]
class Attribut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'attribut', targetEntity: AttributValeur::class, orphanRemoval: true)]
    private Collection $attributValeurs;

    public function __construct()
    {
        $this->attributValeurs = new ArrayCollection();
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
     * @return Collection<int, AttributValeur>
     */
    public function getAttributValeurs(): Collection
    {
        return $this->attributValeurs;
    }

    public function addAttributValeur(AttributValeur $attributValeur): self
    {
        if (!$this->attributValeurs->contains($attributValeur)) {
            $this->attributValeurs[] = $attributValeur;
            $attributValeur->setAttribut($this);
        }

        return $this;
    }

    public function removeAttributValeur(AttributValeur $attributValeur): self
    {
        if ($this->attributValeurs->removeElement($attributValeur)) {
            // set the owning side to null (unless already changed)
            if ($attributValeur->getAttribut() === $this) {
                $attributValeur->setAttribut(null);
            }
        }

        return $this;
    }
}
