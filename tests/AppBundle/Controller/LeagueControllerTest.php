<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LeagueControllerTest extends WebTestCase
{
    /**
     * @var bool
     */
    private $initialized;

    /**
     * @var string
     */
    private $jwt;

    public function testLeagueList()
    {
        echo $this->jwt;
        $client = static::createClient();
        $client->request(
            'GET',
            '/api/leagues',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $this->jwt
            ]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function setUp()
    {
        if(!$this->initialized) {
            $client = static::createClient();

            $client->request(
                'POST',
                '/api/login_check',
                [],
                [],
                ['CONTENT_TYPE' => 'application/json'],
                json_encode([
                    "username" => "admin",
                    "password" => "admin"
                ]));
            $content = json_decode($client->getResponse()->getContent(), true);
            $this->jwt = $content['token'];
        }
    }
}