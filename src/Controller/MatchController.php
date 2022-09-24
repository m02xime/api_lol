<?php

namespace App\Controller;

use App\Entity\Matchs;
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
        $Matchs = $entityManager->getRepository(Matchs::class)->findBy(array('idMatch' => $id, 'puuid' => $puuid));
        if (!$Matchs) {
            $response = $this->Matchs->request(
                'GET',
                'https://europe.api.riotgames.com/lol/match/v5/matches/' . $id,
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
                    $entityManager->persist($Matchs);
                    $entityManager->flush();
                    $Matchs = [$Matchs];
                }
            }
        }
        $Matchs = $serializer->serialize($Matchs, 'json');
        $Matchs = json_decode($Matchs, true);
        return $this->json($Matchs);
    }

    //route 20 dernier matchs par puuid
    #[Route('/matchs/{puuid}', name: 'app_matchs')]
    public function matchs(ManagerRegistry $doctrine, string $puuid): JsonResponse
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $entityManager = $doctrine->getManager();
        $Matchs = $entityManager->getRepository(Matchs::class)->findBy(array('puuid' => $puuid), array('id' => 'ASC'), 20);
        if (!$Matchs || count($Matchs)!=20) {
            $response = $this->Matchs->request(
                'GET',
                'https://europe.api.riotgames.com/lol/match/v5/matches/by-puuid/' . $puuid . '/ids',
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
                    'https://europe.api.riotgames.com/lol/match/v5/matches/' . $id,
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
                        $entityManager->persist($Matchs);
                        $entityManager->flush();
                        $Matchs = $serializer->serialize($Matchs, 'json');
                        $Matchs = json_decode($Matchs, true);
                        $array[] = $Matchs;
                    }
                }
            }
            return $this->json($array);
        }
        $Matchs = $serializer->serialize($Matchs, 'json');
        $Matchs = json_decode($Matchs, true);
        return $this->json($Matchs);
    }
}
