<?php

use Weather\Services\OpenWeatherService;
use Weather\Contracts\WeatherServiceContract;

test('test that we can dependency inject the OpenWeather service', function () {
    $service = app()->make(WeatherServiceContract::class);
    expect($service)->toBeInstanceOf(OpenWeatherService::class);
});

test('test that the OpenWeather service can create a Guzzle client', function () {
    $service = app()->make(WeatherServiceContract::class);
    $client = $service->client();
    expect($client)->toBeInstanceOf(\GuzzleHttp\Client::class);
});

test('test that the OpenWeather service correctly sets its configs', function () {
    $service = app()->make(WeatherServiceContract::class);
    $client = $service->client();

    $config = config('services.openweather');
    $baseUri = $client->getConfig('base_uri');

    expect((string) $baseUri)->toBe($config['base_uri']);
});
