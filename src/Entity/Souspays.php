<?php

namespace App\Entity;

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
}
