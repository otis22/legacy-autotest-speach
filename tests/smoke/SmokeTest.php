<?php

namespace Otis22\BeerMeetup\smoke;

use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;

class SmokeTest extends TestCase
{
    public function testIndexPage(): void
    {
        $client = new  \GuzzleHttp\Client(
            ['base_uri' => 'https://www.shinservice.ru/']
        );
        $this->assertEquals(200, $client->request('GET', '/')->getStatusCode());
    }
    public function testSearchTyres(): void
    {
        $this->assertEquals(
            200,
            $this->httpClient()
                ->request('GET', '/api/search/tyres/facets.json?facets=width,runflat,sale&season=winter&width=155')
                ->getStatusCode()
        );
    }

    private function httpClient(): ClientInterface
    {
        return new  \GuzzleHttp\Client(
            ['base_uri' => 'https://www.shinservice.ru/']
        );
    }
}
