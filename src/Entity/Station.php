<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $idrefliga;

    #[ORM\Column(type: 'integer')]
    private $gares_id;

    #[ORM\Column(type: 'string',length:255)]
    private $geoPoint;

    #[ORM\Column(type: 'string',length:255)]
    private $geoShape;

    #[ORM\Column(type: 'float')]
    private $x;

    #[ORM\Column(type: 'float')]
    private $y;

    #[ORM\Column(type: 'boolean')]
    private $termetro;

    #[ORM\ManyToOne(targetEntity: Gare::class, inversedBy: 'stations')]
    #[ORM\JoinColumn(nullable: false)]
    private $gare;

    #[ORM\OneToMany(mappedBy: 'station', targetEntity: LigneStations::class, orphanRemoval: true)]
    private $ligneStations;

    public function __construct()
    {
        $this->ligneStations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdrefliga(): ?string
    {
        return $this->idrefliga;
    }

    public function setIdrefliga(string $idrefliga): self
    {
        $this->idrefliga = $idrefliga;

        return $this;
    }

    public function getGaresId(): ?int
    {
        return $this->gares_id;
    }

    public function setGaresId(int $gares_id): self
    {
        $this->gares_id = $gares_id;

        return $this;
    }

    public function getGeoPoint(): ?string
    {
        return $this->geoPoint;
    }

    public function setGeoPoint(string $geoPoint): self
    {
        $this->geoPoint = $geoPoint;

        return $this;
    }

    public function getGeoShape(): ?string
    {
        return $this->geoShape;
    }

    public function setGeoShape(string $geoShape): self
    {
        $this->geoShape = $geoShape;

        return $this;
    }

    public function getX(): ?float
    {
        return $this->x;
    }

    public function setX(float $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?float
    {
        return $this->y;
    }

    public function setY(float $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function isTermetro(): ?bool
    {
        return $this->termetro;
    }

    public function setTermetro(bool $termetro): self
    {
        $this->termetro = $termetro;

        return $this;
    }

    public function getGare(): ?Gare
    {
        return $this->gare;
    }

    public function setGare(?Gare $gare): self
    {
        $this->gare = $gare;

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
            $ligneStation->setStation($this);
        }

        return $this;
    }

    public function removeLigneStation(LigneStations $ligneStation): self
    {
        if ($this->ligneStations->removeElement($ligneStation)) {
            // set the owning side to null (unless already changed)
            if ($ligneStation->getStation() === $this) {
                $ligneStation->setStation(null);
            }
        }

        return $this;
    }
}
