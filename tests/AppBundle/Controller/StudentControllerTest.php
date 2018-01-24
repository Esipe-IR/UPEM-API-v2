<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentControllerTest extends WebTestCase
{
    public function testUID()
    {
        $client = static::createClient();
        $client->request('GET', '/api/student/uid/test');
        var_dump($client->getResponse()->getContent());
        static::assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
