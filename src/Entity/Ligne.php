<?php

namespace App\Entity;

use App\Repository\LigneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneRepository::class)]
class Ligne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $ligneCode;

    #[ORM\Column(type: 'string', length: 255)]
    private $resCom;

    #[ORM\Column(type: 'string', length: 255)]
    private $codLigf;

    #[ORM\Column(type: 'string', length: 255)]
    private $indice_lig;

    #[ORM\OneToMany(mappedBy: 'ligne', targetEntity: LigneStations::class, orphanRemoval: true)]
    private $ligneStations;

    public function __construct()
    {
        $this->ligneStations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLigneCode(): ?string
    {
        return $this->ligneCode;
    }

    public function setLigneCode(string $ligneCode): self
    {
        $this->ligneCode = $ligneCode;

        return $this;
    }

    public function getResCom(): ?string
    {
        return $this->resCom;
    }

    public function setResCom(string $resCom): self
    {
        $this->resCom = $resCom;

        return $this;
    }

    public function getCodLigf(): ?string
    {
        return $this->codLigf;
    }

    public function setCodLigf(string $codLigf): self
    {
        $this->codLigf = $codLigf;

        return $this;
    }

    public function getIndiceLig(): ?string
    {
        return $this->indice_lig;
    }

    public function setIndiceLig(string $indice_lig): self
    {
        $this->indice_lig = $indice_lig;

        return $this;
    }

    /**
     * @return Collection<int, LigneStations>
     */
    public function getLigneStations(): Collection
    {
        return $this->ligneStations;
    }

    public function addLigneStation(LigneStations $ligneStation): self
    {
        if (!$this->ligneStations->contains($ligneStation)) {
            $this->ligneStations[] = $ligneStation;
            $ligneStation->setLigne($this);
        }

        return $this;
    }

    public function removeLigneStation(LigneStations $ligneStation): self
    {
        if ($this->ligneStations->removeElement($ligneStation)) {
            // set the owning side to null (unless already changed)
            if ($ligneStation->getLigne() === $this) {
                $ligneStation->setLigne(null);
            }
        }

        return $this;
    }
}
