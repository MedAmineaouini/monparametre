<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $SEQPROD = null;

    #[ORM\Column(length: 50)]
    private ?string $LIBPROD = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ADRESSE = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $TEL = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $EMAIL = null;
    #[ORM\ManyToOne(inversedBy: 'produit', targetEntity: Pays::class)]
    #[ORM\JoinColumn(name: 'IDPAYS', referencedColumnName: 'IDPAYS', nullable: false)]
    private ?Pays $IDPAYS = null;


    public function getSEQPROD(): ?int
    {
        return $this->SEQPROD;
    }

    public function setSEQPROD(int $SEQPROD): static
    {
        $this->SEQPROD = $SEQPROD;

        return $this;
    }

    public function getLIBPROD(): ?string
    {
        return $this->LIBPROD;
    }

    public function setLIBPROD(string $LIBPROD): static
    {
        $this->LIBPROD = $LIBPROD;

        return $this;
    }

    public function getADRESSE(): ?string
    {
        return $this->ADRESSE;
    }

    public function setADRESSE(?string $ADRESSE): static
    {
        $this->ADRESSE = $ADRESSE;

        return $this;
    }

    public function getTEL(): ?string
    {
        return $this->TEL;
    }

    public function setTEL(?string $TEL): static
    {
        $this->TEL = $TEL;

        return $this;
    }

    public function getEMAIL(): ?string
    {
        return $this->EMAIL;
    }

    public function setEMAIL(?string $EMAIL): static
    {
        $this->EMAIL = $EMAIL;

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

}
