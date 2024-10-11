<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'PAYS')]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Ajout de la stratégie AUTO pour la génération
    #[ORM\Column(type: 'integer')] // Assurez-vous que le type est bien spécifié
    private ?int $IDPAYS = null;

    #[ORM\Column(length: 50)]
    private ?string $LIBPAYS = null;

    #[ORM\Column(length: 4)]
    private ?string $CODEPAYS = null;

    public function getIDPAYS(): ?int
    {
        return $this->IDPAYS;
    }

    public function setIDPAYS(int $IDPAYS): static
    {
        $this->IDPAYS = $IDPAYS;

        return $this;
    }

    public function getLIBPAYS(): ?string
    {
        return $this->LIBPAYS;
    }

    public function setLIBPAYS(string $LIBPAYS): static
    {
        $this->LIBPAYS = $LIBPAYS;

        return $this;
    }

    public function getCODEPAYS(): ?string
    {
        return $this->CODEPAYS;
    }

    public function setCODEPAYS(string $CODEPAYS): static
    {
        $this->CODEPAYS = $CODEPAYS;

        return $this;
    }
}
