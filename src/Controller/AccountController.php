<?php

namespace App\Controller;

use App\Entity\Account;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;



#[Route('/api', name: 'api')]
class AccountController extends AbstractController
{
    private $accounts;
    public function __construct(HttpClientInterface $accounts)
    {
        $this->accounts = $accounts;
    }

    #[Route('/account/{username}', name: 'app_account')]
    public function index(ManagerRegistry $doctrine, string $username): JsonResponse
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $entityManager = $doctrine->getManager();
        $Accounts = $entityManager->getRepository(Account::class)->findBy(array('name' => $username));
        if (!$Accounts) {
            $response = $this->accounts->request(
                'GET',
                'https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/' . $username,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'X-Riot-Token' => $this->getParameter('api.key')
                    ]
                ]
            );
            $content = $response->getContent();
            $Accounts = new Account();
            $Accounts = $serializer->deserialize($content, 'App\Entity\Account', 'json');
            $entityManager->persist($Accounts);
            $entityManager->flush();
            $Accounts = [$Accounts];
        }

        $Accounts = $serializer->serialize($Accounts, 'json');
        $Accounts = json_decode($Accounts, true);
        return $this->json($Accounts);
    }
}
