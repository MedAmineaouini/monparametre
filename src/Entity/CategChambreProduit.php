<?php

namespace App\Entity;

use App\Repository\CategChambreProduitRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'CATEGCHAMBREPRODUIT')]
class CategChambreProduit
{
   #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $SEQCATEGCHAMBREPRODUIT = null;

    #[ORM\Column]
    private ?int $SEQCATEGORIECHAMBRE = null;

    #[ORM\ManyToOne(inversedBy: 'CATEGCHAMBREPRODUIT', targetEntity: Produit::class)]
    #[ORM\JoinColumn(name: 'SEQPROD', referencedColumnName: 'SEQPROD', nullable: true)]
    private ?Produit $SEQPROD = null;

    #[ORM\Column(length: 55)]
    private ?string $LIBCATEGCHAMBREPRODUIT = null;

    #[ORM\Column(length: 55, nullable: true)]
    private ?string $LIBCATEGCHAMBREPRODUIT2 = null;

    #[ORM\Column]
    private ?int $STOPSALE = null;


    public function getSEQCATEGCHAMBREPRODUIT(): ?int
    {
        return $this->SEQCATEGCHAMBREPRODUIT;
    }

    public function setSEQCATEGCHAMBREPRODUIT(int $SEQCATEGCHAMBREPRODUIT): static
    {
        $this->SEQCATEGCHAMBREPRODUIT = $SEQCATEGCHAMBREPRODUIT;

        return $this;
    }

    public function getSEQCATEGORIECHAMBRE(): ?int
    {
        return $this->SEQCATEGORIECHAMBRE;
    }

    public function setSEQCATEGORIECHAMBRE(int $SEQCATEGORIECHAMBRE): static
    {
        $this->SEQCATEGORIECHAMBRE = $SEQCATEGORIECHAMBRE;

        return $this;
    }

    public function getSEQPROD(): ?Produit
    {
        return $this->SEQPROD;
    }

    public function setSEQPROD(?Produit $SEQPROD): static
    {
        $this->SEQPROD = $SEQPROD;

        return $this;
    }

    public function getLIBCATEGCHAMBREPRODUIT(): ?string
    {
        return $this->LIBCATEGCHAMBREPRODUIT;
    }

    public function setLIBCATEGCHAMBREPRODUIT(string $LIBCATEGCHAMBREPRODUIT): static
    {
        $this->LIBCATEGCHAMBREPRODUIT = $LIBCATEGCHAMBREPRODUIT;

        return $this;
    }

    public function getLIBCATEGCHAMBREPRODUIT2(): ?string
    {
        return $this->LIBCATEGCHAMBREPRODUIT2;
    }

    public function setLIBCATEGCHAMBREPRODUIT2(?string $LIBCATEGCHAMBREPRODUIT2): static
    {
        $this->LIBCATEGCHAMBREPRODUIT2 = $LIBCATEGCHAMBREPRODUIT2;

        return $this;
    }

    public function getSTOPSALE(): ?int
    {
        return $this->STOPSALE;
    }

    public function setSTOPSALE(int $STOPSALE): static
    {
        $this->STOPSALE = $STOPSALE;

        return $this;
    }

}
