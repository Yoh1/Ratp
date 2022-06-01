<?php

namespace App\Entity;

use App\Repository\LigneStationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneStationsRepository::class)]
class LigneStations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: 'ligneStations')]
    #[ORM\JoinColumn(nullable: false)]
    private $station;

    #[ORM\ManyToOne(targetEntity: Ligne::class, inversedBy: 'ligneStations')]
    #[ORM\JoinColumn(nullable: false)]
    private $ligne;

    #[ORM\Column(type: 'string', length: 255)]
    private $ligneCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getLigne(): ?Ligne
    {
        return $this->ligne;
    }

    public function setLigne(?Ligne $ligne): self
    {
        $this->ligne = $ligne;

        return $this;
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
}
