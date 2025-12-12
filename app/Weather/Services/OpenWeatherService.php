<?php

namespace Weather\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Weather\Contracts\WeatherServiceContract;
use Weather\Entities\Location;
use Weather\Traits\UsesGuzzleClient;
use Weather\Exceptions\ExceptionHandler;
use Weather\Exceptions\JsonException;

class OpenWeatherService implements WeatherServiceContract
{
    use UsesGuzzleClient;

    private string $base_uri = 'https://api.openweathermap.org';
    private string $search_endpoint = '/data/2.5/forecast';

    private string $apiKey;

    public function search(string $location): ?Collection
    {
        $location = new Location(name: $location);

        return Cache::remember('weather_' . md5($location->getName()), now()->addHours(1), function () use ($location) {
            return $this->getByLocation($location);
        });
    }

    public function getByLocation(Location $location): ?Collection
    {
        try {
            $response = $this->client->get($this->search_endpoint, [
                'query' => [
                    'q' => $location->searchString(),
                    'appid' => $this->apiKey,
                    'units' => 'metric',
                ],
            ]);
        } catch (\Throwable $e) {
            throw ExceptionHandler::from($e);
        }

        try {
            $data = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new JsonException(message: 'Failed to parse weather response: '.$e->getMessage(), previous: $e);
        }

        if (!isset($data['list']) || empty($data['list'])) {
            return null;
        }

        return collect($data['list'][0]);
    }
}
