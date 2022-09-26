<?php

namespace App\Entity;

use App\Repository\MatchTimelineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchTimelineRepository::class)]
class MatchTimeline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idMatch = null;

    #[ORM\Column]
    private array $MatchJson = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMatch(): ?string
    {
        return $this->idMatch;
    }

    public function setIdMatch(string $idMatch): self
    {
        $this->idMatch = $idMatch;

        return $this;
    }

    public function getMatchJson(): array
    {
        return $this->MatchJson;
    }

    public function setMatchJson(array $MatchJson): self
    {
        $this->MatchJson = $MatchJson;

        return $this;
    }
}
