<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'SOUSPAYS')]
class Souspays
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Ajout de la stratégie AUTO pour la génération
    #[ORM\Column(type: 'integer')]
    private ?int $SEQSOUSPAYS = null;

    #[ORM\Column(length: 50)]
    private ?string $LIBSOUSPAYS = null;


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
}
