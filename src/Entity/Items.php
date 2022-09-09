<?php

namespace App\Entity;

use App\Repository\ItemsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemsRepository::class)]
class Items
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $itemID = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $plaintext = null;

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

    #[ORM\Column]
    private ?int $gold = null;

    #[ORM\Column(nullable: true)]
    private array $stats = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemID(): ?int
    {
        return $this->itemID;
    }

    public function setItemID(int $itemID): self
    {
        $this->itemID = $itemID;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPlaintext(): ?string
    {
        return $this->plaintext;
    }

    public function setPlaintext(string $plaintext): self
    {
        $this->plaintext = $plaintext;

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

    public function getGold(): ?int
    {
        return $this->gold;
    }

    public function setGold(int $gold): self
    {
        $this->gold = $gold;

        return $this;
    }

    public function getStats(): array
    {
        return $this->stats;
    }

    public function setStats(?array $stats): self
    {
        $this->stats = $stats;

        return $this;
    }
}
