<?php

namespace App\Controller;

use App\Entity\Champions;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api')]
class ChampionController extends AbstractController
{
    private $champions;
    public function __construct(HttpClientInterface $champions)
    {
        $this->champions = $champions;
    }
    #[Route('/champions', name: 'app_champion')]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {

        $entityManager = $doctrine->getManager();
        $response = $this->champions->request(
            'GET',
            'https://ddragon.leagueoflegends.com/cdn/12.17.1/data/fr_FR/champion.json'
        );

        $content = $response->toarray()['data'];
        $championnbr = 0;
        foreach ($content as $key => $champion) {
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
}
