<?php

namespace App\Entity;

use App\Repository\SpellRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpellRepository::class)]
class Spell
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idname = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $idKey = null;

    #[ORM\Column(length: 255)]
    private ?string $imageFull = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdname(): ?string
    {
        return $this->idname;
    }

    public function setIdname(string $idname): self
    {
        $this->idname = $idname;

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

    public function getIdKey(): ?int
    {
        return $this->idKey;
    }

    public function setIdKey(int $idKey): self
    {
        $this->idKey = $idKey;

        return $this;
    }

    public function getImageFull(): ?string
    {
        return $this->imageFull;
    }

    public function setImageFull(string $imageFull): self
    {
        $this->imageFull = $imageFull;

        return $this;
    }
}
