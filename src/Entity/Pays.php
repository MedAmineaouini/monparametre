<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'PAYS')]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Ajout de la stratégie AUTO pour la génération
    #[ORM\Column(type: 'integer',name: 'IDPAYS')] // Assurez-vous que le type est bien spécifié
    private ?int $IDPAYS = null;

    #[ORM\Column(length: 50)]
    private ?string $LIBPAYS = null;

    #[ORM\Column(length: 4)]
    private ?string $CODEPAYS = null;

    /**
     * @var Collection<int, Souspays>
     */
    #[ORM\OneToMany(targetEntity: Souspays::class, mappedBy: 'IDPAYS')]
    private Collection $souspays;

    public function __construct()
    {
        $this->souspays = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Souspays>
     */
    public function getSouspays(): Collection
    {
        return $this->souspays;
    }

    public function addSouspay(Souspays $souspay): static
    {
        if (!$this->souspays->contains($souspay)) {
            $this->souspays->add($souspay);
            $souspay->setIDPAYS($this);
        }

        return $this;
    }

    public function removeSouspay(Souspays $souspay): static
    {
        if ($this->souspays->removeElement($souspay)) {
            // set the owning side to null (unless already changed)
            if ($souspay->getIDPAYS() === $this) {
                $souspay->setIDPAYS(null);
            }
        }

        return $this;
    }
}
