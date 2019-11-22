<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SubscriptionControllerTest extends WebTestCase
{

    public function showAction()
    {
        $client = static::createClient();
        $this->execQuery($client, 'GET', null, '/subscription/1');
        $response = $client->getResponse();
        $this->assertJsonResponse($response, 401);
    }


}
