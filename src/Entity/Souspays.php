<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'SOUSPAYS')]
class Souspays
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Ajout de la stratégie AUTO pour la génération
    #[ORM\Column(type: 'integer', name: 'SEQSOUSPAYS')]
    private ?int $SEQSOUSPAYS = null;

    #[ORM\Column(length: 50)]
    private ?string $LIBSOUSPAYS = null;

    #[ORM\ManyToOne(inversedBy: 'souspays', targetEntity: Pays::class)]
    #[ORM\JoinColumn(name: 'IDPAYS', referencedColumnName: 'IDPAYS', nullable: false)]
    private ?Pays $IDPAYS = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'SEQSOUSPAYS')]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }


    public function getSEQSOUSPAYS(): ?int
    {
        return $this->SEQSOUSPAYS;
    }

    public function setSEQSOUSPAYS(int $SEQSOUSPAYS): static
    {
        $this->SEQSOUSPAYS = $SEQSOUSPAYS;

        return $this;
    }

    public function getLIBSOUSPAYS(): ?string
    {
        return $this->LIBSOUSPAYS;
    }

    public function setLIBSOUSPAYS(string $LIBSOUSPAYS): static
    {
        $this->LIBSOUSPAYS = $LIBSOUSPAYS;

        return $this;
    }

    public function getIDPAYS(): ?Pays
    {
        return $this->IDPAYS;
    }

    public function setIDPAYS(?Pays $IDPAYS): static
    {
        $this->IDPAYS = $IDPAYS;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setSEQSOUSPAYS($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getSEQSOUSPAYS() === $this) {
                $produit->setSEQSOUSPAYS(null);
            }
        }

        return $this;
    }
}
