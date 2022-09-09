<?php

namespace App\Entity;

use App\Repository\ChampionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampionsRepository::class)]
class Champions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idName = null;

    #[ORM\Column]
    private ?int $idChamp = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $blurb = null;

    #[ORM\Column(length: 255)]
    private ?string $imagefull = null;

    #[ORM\Column(length: 255)]
    private ?string $imagesprite = null;

    #[ORM\Column]
    private ?int $spriteX = null;

    #[ORM\Column]
    private ?int $spriteY = null;

    #[ORM\Column]
    private ?int $spriteH = null;

    #[ORM\Column]
    private ?int $spriteW = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdName(): ?string
    {
        return $this->idName;
    }

    public function setIdName(string $idName): self
    {
        $this->idName = $idName;

        return $this;
    }

    public function getIdChamp(): ?int
    {
        return $this->idChamp;
    }

    public function setIdChamp(int $idChamp): self
    {
        $this->idChamp = $idChamp;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBlurb(): ?string
    {
        return $this->blurb;
    }

    public function setBlurb(string $blurb): self
    {
        $this->blurb = $blurb;

        return $this;
    }

    public function getImagefull(): ?string
    {
        return $this->imagefull;
    }

    public function setImagefull(string $imagefull): self
    {
        $this->imagefull = $imagefull;

        return $this;
    }

    public function getImagesprite(): ?string
    {
        return $this->imagesprite;
    }

    public function setImagesprite(string $imagesprite): self
    {
        $this->imagesprite = $imagesprite;

        return $this;
    }

    public function getSpriteX(): ?int
    {
        return $this->spriteX;
    }

    public function setSpriteX(int $spriteX): self
    {
        $this->spriteX = $spriteX;

        return $this;
    }

    public function getSpriteY(): ?int
    {
        return $this->spriteY;
    }

    public function setSpriteY(int $spriteY): self
    {
        $this->spriteY = $spriteY;

        return $this;
    }

    public function getSpriteH(): ?int
    {
        return $this->spriteH;
    }

    public function setSpriteH(int $spriteH): self
    {
        $this->spriteH = $spriteH;

        return $this;
    }

    public function getSpriteW(): ?int
    {
        return $this->spriteW;
    }

    public function setSpriteW(int $spriteW): self
    {
        $this->spriteW = $spriteW;

        return $this;
    }
}
