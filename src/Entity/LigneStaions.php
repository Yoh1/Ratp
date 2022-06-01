<?php

namespace App\Entity;

use App\Repository\LigneStaionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneStaionsRepository::class)]
class LigneStaions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $ligneCode;

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
}
