<?php

namespace App\Entity;

use App\Repository\MatchDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchDetailsRepository::class)]
class MatchDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $MatchId = null;

    #[ORM\Column]
    private array $MatchJson = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatchId(): ?int
    {
        return $this->MatchId;
    }

    public function setMatchId(int $MatchId): self
    {
        $this->MatchId = $MatchId;

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
