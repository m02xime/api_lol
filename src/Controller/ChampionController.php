<?php

namespace App\Controller;

use App\Entity\Champions;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

#[Route('/api', name: 'api')]
class ChampionController extends AbstractController
{
    private $champions;
    public function __construct(HttpClientInterface $champions)
    {
        $this->champions = $champions;
    }
    #[Route('/BDDchampions', name: 'app_champion')]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {

        $entityManager = $doctrine->getManager();
        $response = $this->champions->request(
            'GET',
            'https://ddragon.leagueoflegends.com/cdn/12.17.1/data/fr_FR/champion.json'
        );

        $content = $response->toarray()['data'];
        $championnbr = 0;
        foreach ($content as $champion) {
            $champions = $entityManager->getRepository(champions::class)->findBy(array('idName' => $champion['id']));
            if (!$champions) {

                $champions = new Champions();
                $champions->setIdName($champion['id']);
                $champions->setIdChamp($champion['key']);
                $champions->setName($champion['name']);
                $champions->setTitle($champion['title']);
                $champions->setBlurb($champion['blurb']);
                $champions->setImagefull($champion['image']["full"]);
                $champions->setImagesprite($champion['image']['sprite']);
                $champions->setSpriteX($champion['image']['x']);
                $champions->setSpriteY($champion['image']['y']);
                $champions->setSpriteH($champion['image']['h']);
                $champions->setSpriteW($champion['image']['w']);


                $entityManager->persist($champions);
                $entityManager->flush();
                $championnbr++;
            }
        }




        return $this->json(["message" => "champions mis en base : " . $championnbr]);
    }

    //get all champion from database
    #[Route('/champions', name: 'app_champions')]
    public function getChampions(ManagerRegistry $doctrine): JsonResponse
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $entityManager = $doctrine->getManager();
        $entityManager = $doctrine->getManager();
        $champions = $entityManager->getRepository(champions::class)->findAll();
        $champions = $serializer->serialize($champions, 'json');
        $champions = json_decode($champions, true);
        return $this->json($champions);
    }
}
