<?php

namespace Otis22\BeerMeetup\integration;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    #[DataProvider('getTyresWidthsValues')]
    public function testSearchTyresByWidth(int $width): void
    {
        $response = $this->response('api/search/tyres.json?page=1&width[]=' . $width);
        $this->assertGreaterThan(0, count($response['payload']['models']));
    }

    /**
     * @return array<array<int>>
     */
    public static function getTyresWidthsValues(): array
    {
        return [[155], [165], [175]];
    }

    private function httpClient(): \GuzzleHttp\Client
    {
        return new \GuzzleHttp\Client(
            ['base_uri' => 'https://www.shinservice.ru/']
        );
    }

    /**
     * @param string $url
     * @return array<array<array<mixed>>>
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function response(string $url): array
    {
        $response = json_decode(
            $this->httpClient()
                ->request('GET', $url)
                ->getBody()
                ->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        if (is_array($response)) {
            return  $response;
        }
        throw new \Exception("Invalid Server response");
    }
}
