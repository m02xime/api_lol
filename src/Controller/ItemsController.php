<?php

namespace App\Controller;

use App\Entity\Items;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api')]
class ItemsController extends AbstractController
{

    private $items;
    public function __construct(HttpClientInterface $items)
    {
        $this->items = $items;
    }
    #[Route('/items', name: 'app_items')]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {

        $entityManager = $doctrine->getManager();
        $response = $this->items->request(
            'GET',
            'https://ddragon.leagueoflegends.com/cdn/12.17.1/data/fr_FR/item.json'
        );

        $content = $response->toarray()['data'];
        $itemnbr=0;
        foreach ($content as $key => $item) {

            $items = $entityManager->getRepository(items::class)->findBy(array('itemID' => $key));
            if (!$items) {
                $items = new Items();
                $items->setItemID($key);
                $items->setName($item['name']);
                $items->setDescription($item['description']);
                $items->setPlaintext($item['plaintext']);
                $items->setImagefull($item['image']['full']);
                $items->setImagesprite($item['image']['sprite']);
                $items->setSpriteX($item['image']['x']);
                $items->setSpriteY($item['image']['y']);
                $items->setSpriteH($item['image']['h']);
                $items->setSpriteW($item['image']['w']);
                $items->setGold($item['gold']['total']);
                $items->setStats($item['stats']);

                $entityManager->persist($items);
                $entityManager->flush();
                $itemnbr++;
            }
        }




        return $this->json(["message"=>"items mis en base : ".$itemnbr]);
    }
}
