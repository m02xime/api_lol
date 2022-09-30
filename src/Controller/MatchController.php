<?php

namespace App\Controller;

use App\Entity\Matchs;
use App\Entity\MatchTimeline;
use App\Entity\Account;
use App\Entity\MatchDetails;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

#[Route('/api', name: 'api')]
class MatchController extends AbstractController
{
    private $Matchs;
    public function __construct(HttpClientInterface $Matchs)
    {
        $this->Matchs = $Matchs;
    }
    #[Route('/match/{id}/account/{puuid}', name: 'app_match')]
    public function index(ManagerRegistry $doctrine, string $id, string $puuid): JsonResponse
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $entityManager = $doctrine->getManager();
        $Account = $entityManager->getRepository(Account::class)->findBy(array('puuid' => $puuid));
        $regions = array("euw1" => "europe", "eun1" => "europe", "na1" => "americas", "br1" => "americas", "la1" => "americas", "la2" => "americas", "oc1" => "sea", "ru" => "asia", "tr1" => "europe", "jp1" => "asia", "kr" => "asia");
        $region = $regions[$Account[0]->getRegion()];
        $MatchDetails = $entityManager->getRepository(MatchDetails::class)->findBy(array('MatchId' => $id));
        if (!$MatchDetails) {
            $response = $this->Matchs->request(
                'GET',
                'https://' . $region . '.api.riotgames.com/lol/match/v5/matches/' . $id,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'X-Riot-Token' => $this->getParameter('api.key')
                    ]
                ]
            );
            $content = $response->toarray();


            $MatchDetails = new MatchDetails();
            $MatchDetails->setMatchId($id);
            $MatchDetails->setMatchJson($content["info"]);
            $entityManager->persist($MatchDetails);
            $entityManager->flush();
        }
        $MatchDetails = $serializer->serialize($MatchDetails, 'json');
        $MatchDetails = json_decode($MatchDetails, true);
        return $this->json($MatchDetails);
    }

    //route 20 dernier matchs par puuid
    #[Route('/matchs/{puuid}', name: 'app_matchs')]
    public function matchs(ManagerRegistry $doctrine, string $puuid): JsonResponse
    {
        $array=array();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $entityManager = $doctrine->getManager();
        $Account = $entityManager->getRepository(Account::class)->findBy(array('puuid' => $puuid));
        $regions = array("euw1" => "europe", "eun1" => "europe", "na1" => "americas", "br1" => "americas", "la1" => "americas", "la2" => "americas", "oc1" => "sea", "ru" => "asia", "tr1" => "europe", "jp1" => "asia", "kr" => "asia");
        $region = $regions[$Account[0]->getRegion()];
        $Matchs = $entityManager->getRepository(Matchs::class)->findBy(array('puuid' => $puuid), array('id' => 'ASC'), 20);
        if (!$Matchs || count($Matchs) != 20) {
            $response = $this->Matchs->request(
                'GET',
                'https://' . $region . '.api.riotgames.com/lol/match/v5/matches/by-puuid/' . $puuid . '/ids',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'X-Riot-Token' => $this->getParameter('api.key')
                    ]
                ]
            );
            $content = $response->toarray();
            foreach ($content as $id) {
                $response = $this->Matchs->request(
                    'GET',
                    'https://' . $region . '.api.riotgames.com/lol/match/v5/matches/' . $id,
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'X-Riot-Token' => $this->getParameter('api.key')
                        ]
                    ]
                );
                $content = $response->toarray();
                foreach ($content["info"]["participants"] as $partipant) {
                    if ($partipant["puuid"] == $puuid) {
                        $Matchs = new Matchs();
                        $Matchs->setPuuid($puuid);
                        $Matchs->setAssists($partipant['assists']);
                        $Matchs->setChampLevel($partipant['champLevel']);
                        $Matchs->setChampionId($partipant['championId']);
                        $Matchs->setChampionName($partipant['championName']);
                        $Matchs->setDeaths($partipant['deaths']);
                        $Matchs->setItem0($partipant['item0']);
                        $Matchs->setItem1($partipant['item1']);
                        $Matchs->setItem2($partipant['item2']);
                        $Matchs->setItem3($partipant['item3']);
                        $Matchs->setItem4($partipant['item4']);
                        $Matchs->setItem5($partipant['item5']);
                        $Matchs->setItem6($partipant['item6']);
                        $Matchs->setKills($partipant['kills']);
                        $Matchs->setTotalDamageDealt($partipant['totalDamageDealt']);
                        $Matchs->setProfileIcon($partipant['profileIcon']);
                        $Matchs->setSummonerId($partipant['summonerId']);
                        $Matchs->setSummonerLevel($partipant['summonerLevel']);
                        $Matchs->setSummonerName($partipant['summonerName']);
                        $Matchs->setTimePlayed($partipant['timePlayed']);
                        $Matchs->setWin($partipant['win']);
                        $Matchs->setGoldEarned($partipant['goldEarned']);
                        $Matchs->setBaronKills($partipant['baronKills']);
                        $Matchs->setDragonKills($partipant['dragonKills']);
                        $Matchs->setSummoner1Id($partipant['summoner1Id']);
                        $Matchs->setSummoner2Id($partipant['summoner2Id']);
                        $Matchs->setTotalMinionsKilled($partipant['totalMinionsKilled']);
                        $Matchs->setTurretLost($partipant['turretsLost']);
                        $Matchs->setVisionWardsBoughtInGame($partipant['visionWardsBoughtInGame']);
                        $Matchs->setIdMatch($content['metadata']['matchId']);
                        $Matchs->setGameMode($content['info']['gameMode']);
                        $entityManager->persist($Matchs);
                        $entityManager->flush();
                        $Matchs = $serializer->serialize($Matchs, 'json');
                        $Matchs = json_decode($Matchs, true);
                        $array[] = $Matchs;
                    }
                }
            }
            return $this->json($Matchs);
        }
        $Matchs = $serializer->serialize($Matchs, 'json');
        $Matchs = json_decode($Matchs, true);
        return $this->json($Matchs);
    }

    //route recuperer un match timeline par matchId
    #[Route('/match/timeline/{matchId}', name: 'app_matchs_timeline')]
    public function matchTimeline(ManagerRegistry $doctrine, string $matchId): JsonResponse
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $entityManager = $doctrine->getManager();
        $region = strtolower(strtok($matchId, "_"));
        $regions = array("euw1" => "europe", "eun1" => "europe", "na1" => "americas", "br1" => "americas", "la1" => "americas", "la2" => "americas", "oc1" => "sea", "ru" => "asia", "tr1" => "europe", "jp1" => "asia", "kr" => "asia");
        $region = $regions[$region];
        $MatchTimeline = $entityManager->getRepository(MatchTimeline::class)->findOneBy(array('idMatch' => $matchId));
        if (!$MatchTimeline) {
            $response = $this->Matchs->request(
                'GET',
                'https://' . $region . '.api.riotgames.com/lol/match/v5/matches/' . $matchId . '/timeline',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'X-Riot-Token' => $this->getParameter('api.key')
                    ]
                ]
            );
            $content = $response->toArray();
            $MatchTimeline = new MatchTimeline();
            $MatchTimeline->setIdMatch($matchId);
            $MatchTimeline->setMatchJson($content["info"]);
            $entityManager->persist($MatchTimeline);
            $entityManager->flush();
        }
        $MatchTimeline = $serializer->serialize($MatchTimeline, 'json');
        $MatchTimeline = json_decode($MatchTimeline, true);
        return $this->json($MatchTimeline);
    }
}
