<?php

namespace App\Entity;

use App\Repository\MatchsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchsRepository::class)]
class Matchs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $assists = null;

    #[ORM\Column]
    private ?int $champLevel = null;

    #[ORM\Column]
    private ?int $championId = null;

    #[ORM\Column(length: 255)]
    private ?string $championName = null;

    #[ORM\Column]
    private ?int $deaths = null;

    #[ORM\Column]
    private ?int $item0 = null;

    #[ORM\Column]
    private ?int $item1 = null;

    #[ORM\Column]
    private ?int $item2 = null;

    #[ORM\Column]
    private ?int $item3 = null;

    #[ORM\Column]
    private ?int $item4 = null;

    #[ORM\Column]
    private ?int $item5 = null;

    #[ORM\Column]
    private ?int $item6 = null;

    #[ORM\Column]
    private ?int $kills = null;

    #[ORM\Column]
    private ?int $totalDamageDealt = null;

    #[ORM\Column]
    private ?int $profileIcon = null;

    #[ORM\Column(length: 255)]
    private ?string $summonerId = null;

    #[ORM\Column]
    private ?int $summonerLevel = null;

    #[ORM\Column(length: 255)]
    private ?string $summonerName = null;

    #[ORM\Column]
    private ?int $timePlayed = null;

    #[ORM\Column]
    private ?bool $win = null;

    #[ORM\Column]
    private ?int $goldEarned = null;

    #[ORM\Column]
    private ?int $baronKills = null;

    #[ORM\Column]
    private ?int $dragonKills = null;

    #[ORM\Column]
    private ?int $summoner1Id = null;

    #[ORM\Column]
    private ?int $summoner2Id = null;

    #[ORM\Column]
    private ?int $totalMinionsKilled = null;

    #[ORM\Column]
    private ?int $turretLost = null;

    #[ORM\Column]
    private ?int $visionWardsBoughtInGame = null;

    #[ORM\Column(length: 255)]
    private ?string $idMatch = null;

    #[ORM\Column(length: 255)]
    private ?string $puuid = null;

    #[ORM\Column(length: 255)]
    private ?string $gameMode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssists(): ?int
    {
        return $this->assists;
    }

    public function setAssists(int $assists): self
    {
        $this->assists = $assists;

        return $this;
    }

    public function getChampLevel(): ?int
    {
        return $this->champLevel;
    }

    public function setChampLevel(int $champLevel): self
    {
        $this->champLevel = $champLevel;

        return $this;
    }

    public function getChampionId(): ?int
    {
        return $this->championId;
    }

    public function setChampionId(int $championId): self
    {
        $this->championId = $championId;

        return $this;
    }

    public function getChampionName(): ?string
    {
        return $this->championName;
    }

    public function setChampionName(string $championName): self
    {
        $this->championName = $championName;

        return $this;
    }

    public function getDeaths(): ?int
    {
        return $this->deaths;
    }

    public function setDeaths(int $deaths): self
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getItem0(): ?int
    {
        return $this->item0;
    }

    public function setItem0(int $item0): self
    {
        $this->item0 = $item0;

        return $this;
    }

    public function getItem1(): ?int
    {
        return $this->item1;
    }

    public function setItem1(int $item1): self
    {
        $this->item1 = $item1;

        return $this;
    }

    public function getItem2(): ?int
    {
        return $this->item2;
    }

    public function setItem2(int $item2): self
    {
        $this->item2 = $item2;

        return $this;
    }

    public function getItem3(): ?int
    {
        return $this->item3;
    }

    public function setItem3(int $item3): self
    {
        $this->item3 = $item3;

        return $this;
    }

    public function getItem4(): ?int
    {
        return $this->item4;
    }

    public function setItem4(int $item4): self
    {
        $this->item4 = $item4;

        return $this;
    }

    public function getItem5(): ?int
    {
        return $this->item5;
    }

    public function setItem5(int $item5): self
    {
        $this->item5 = $item5;

        return $this;
    }

    public function getItem6(): ?int
    {
        return $this->item6;
    }

    public function setItem6(int $item6): self
    {
        $this->item6 = $item6;

        return $this;
    }

    public function getKills(): ?int
    {
        return $this->kills;
    }

    public function setKills(int $kills): self
    {
        $this->kills = $kills;

        return $this;
    }

    public function getTotalDamageDealt(): ?int
    {
        return $this->totalDamageDealt;
    }

    public function setTotalDamageDealt(int $totalDamageDealt): self
    {
        $this->totalDamageDealt = $totalDamageDealt;

        return $this;
    }

    public function getProfileIcon(): ?int
    {
        return $this->profileIcon;
    }

    public function setProfileIcon(int $profileIcon): self
    {
        $this->profileIcon = $profileIcon;

        return $this;
    }

    public function getSummonerId(): ?string
    {
        return $this->summonerId;
    }

    public function setSummonerId(string $summonerId): self
    {
        $this->summonerId = $summonerId;

        return $this;
    }

    public function getSummonerLevel(): ?int
    {
        return $this->summonerLevel;
    }

    public function setSummonerLevel(int $summonerLevel): self
    {
        $this->summonerLevel = $summonerLevel;

        return $this;
    }

    public function getSummonerName(): ?string
    {
        return $this->summonerName;
    }

    public function setSummonerName(string $summonerName): self
    {
        $this->summonerName = $summonerName;

        return $this;
    }

    public function getTimePlayed(): ?int
    {
        return $this->timePlayed;
    }

    public function setTimePlayed(int $timePlayed): self
    {
        $this->timePlayed = $timePlayed;

        return $this;
    }

    public function isWin(): ?bool
    {
        return $this->win;
    }

    public function setWin(bool $win): self
    {
        $this->win = $win;

        return $this;
    }

    public function getGoldEarned(): ?int
    {
        return $this->goldEarned;
    }

    public function setGoldEarned(int $goldEarned): self
    {
        $this->goldEarned = $goldEarned;

        return $this;
    }

    public function getBaronKills(): ?int
    {
        return $this->baronKills;
    }

    public function setBaronKills(int $baronKills): self
    {
        $this->baronKills = $baronKills;

        return $this;
    }

    public function getDragonKills(): ?int
    {
        return $this->dragonKills;
    }

    public function setDragonKills(int $dragonKills): self
    {
        $this->dragonKills = $dragonKills;

        return $this;
    }

    public function getSummoner1Id(): ?int
    {
        return $this->summoner1Id;
    }

    public function setSummoner1Id(int $summoner1Id): self
    {
        $this->summoner1Id = $summoner1Id;

        return $this;
    }

    public function getSummoner2Id(): ?int
    {
        return $this->summoner2Id;
    }

    public function setSummoner2Id(int $summoner2Id): self
    {
        $this->summoner2Id = $summoner2Id;

        return $this;
    }

    public function getTotalMinionsKilled(): ?int
    {
        return $this->totalMinionsKilled;
    }

    public function setTotalMinionsKilled(int $totalMinionsKilled): self
    {
        $this->totalMinionsKilled = $totalMinionsKilled;

        return $this;
    }

    public function getTurretLost(): ?int
    {
        return $this->turretLost;
    }

    public function setTurretLost(int $turretLost): self
    {
        $this->turretLost = $turretLost;

        return $this;
    }

    public function getVisionWardsBoughtInGame(): ?int
    {
        return $this->visionWardsBoughtInGame;
    }

    public function setVisionWardsBoughtInGame(int $visionWardsBoughtInGame): self
    {
        $this->visionWardsBoughtInGame = $visionWardsBoughtInGame;

        return $this;
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

    public function getPuuid(): ?string
    {
        return $this->puuid;
    }

    public function setPuuid(string $puuid): self
    {
        $this->puuid = $puuid;

        return $this;
    }

    public function getGameMode(): ?string
    {
        return $this->gameMode;
    }

    public function setGameMode(string $gameMode): self
    {
        $this->gameMode = $gameMode;

        return $this;
    }
}
