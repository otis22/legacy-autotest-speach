<?php

namespace Otis22\BeerMeetup;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;

class SmokeTest extends TestCase
{
    public function testIndexPage(): void
    {
        $client = new Client(
            ['base_uri' => 'https://www.shinservice.ru/']
        );
        $this->assertEquals(
            200,
            $client->get('/')->getStatusCode()
        );
    }
    public function testSearchTyres(): void
    {
        $this->assertEquals(
            200,
            $this->httpClient()
                ->get('/api/search/tyres/facets.json?facets=width,runflat,sale&season=winter&width=155')->getStatusCode()
        );
    }

    private function httpClient(): ClientInterface
    {
        return new Client(
            ['base_uri' => 'https://www.shinservice.ru/']
        );
    }
}