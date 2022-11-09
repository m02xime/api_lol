<?php

// tests/Service/MatchControllerTest.php
namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MatchControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = self::createClient();
        $client->request('GET', '/api/match/EUW1_6141642126/account/YCMb0W79SBOE95yo6y0IR4_QmjfDz87aGEpYsXcEoMtgFU7RhCIS6XmV2C_R4v48j3SlrrIYwIyKeQ');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertSame(200,$client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
    }
}