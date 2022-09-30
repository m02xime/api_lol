<?php

namespace App\Controller;

use App\Entity\Spell;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

#[Route('/api', name: 'api')]

class SpellController extends AbstractController
{
    private $spell;
    public function __construct(HttpClientInterface $spell)
    {
        $this->spell = $spell;
    }
    //get BDDSpell
    #[Route('/BDDSpell', name: 'app_BDDSpell')]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $response = $this->spell->request(
            'GET',
            'https://ddragon.leagueoflegends.com/cdn/12.17.1/data/fr_FR/summoner.json'
        );

        $content = $response->toarray()['data'];
        $spellnbr = 0;
        foreach ($content as $key => $spell) {

            $spells = $entityManager->getRepository(spell::class)->findBy(array('idKey' => $key));
            if (!$spells) {
                $spells = new Spell();
                $spells->setIdname($spell["id"]);
                $spells->setIdKey($spell["key"]);
                $spells->setName($spell['name']);
                $spells->setDescription($spell['description']);
                $spells->setImagefull($spell['image']['full']);
                $entityManager->persist($spells);
                $entityManager->flush();
                $spellnbr++;
            }
        }
        return $this->json(["message" => "spell mis en base : " . $spellnbr]);
    }

    //get one spell from database
    #[Route('/spell/{id}', name: 'app_spell')]
    public function getItem(ManagerRegistry $doctrine, $id): JsonResponse
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $entityManager = $doctrine->getManager();
        $spell = $entityManager->getRepository(Spell::class)->findBy(array('idKey' => $id));
        $spell = $serializer->serialize($spell, 'json');
        $spell = json_decode($spell, true);
        return $this->json($spell);
    }

    //get all spell from database
    #[Route('/spell', name: 'app_spell_all')]
    public function getAllItem(ManagerRegistry $doctrine): JsonResponse
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $entityManager = $doctrine->getManager();
        $spell = $entityManager->getRepository(Spell::class)->findAll();
        $spell = $serializer->serialize($spell, 'json');
        $spell = json_decode($spell, true);
        return $this->json($spell);
    }
}
