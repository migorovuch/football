<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLeagueList()
    {
        $client = static::createClient();

        $client->request('GET', '/api/leagues');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    public function testAuthenticationSuccess()
    {
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

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey("token", $content);
    }

    public function testAuthenticationFailure()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "username" => "admin",
                "password" => "wrongPassword"
            ]));

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
        $content = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey("message", $content);
        $this->assertEquals("Bad credentials", $content['message']);
    }
}
