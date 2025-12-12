<?php

use Illuminate\Support\Facades\Exceptions;
use Weather\Contracts\WeatherServiceContract;
use Weather\Exceptions\RequestException;

test('test that we can get weather data from OpenWeather service for a valid location', function () {
    $service = app()->make(WeatherServiceContract::class);

    $data = $service->search('Nuneaton');

    expect($data)
        ->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->and($data->isNotEmpty())->toBeTrue()
        ->and($data->has('dt'))->toBeTrue()
        ->and($data->has('main'))->toBeTrue()
        ->and($data->has('weather'))->toBeTrue()
        ->and($data->has('wind'))->toBeTrue();
});

test('test that we are caching weather data from OpenWeather service for a valid location', function () {
    $service = app()->make(WeatherServiceContract::class);

    $service->search('Nuneaton');
    $cacheKey = 'weather_' . md5('Nuneaton');

    expect(\Illuminate\Support\Facades\Cache::has($cacheKey))->toBeTrue();
});

test('test that we handle invalid location gracefully from OpenWeather service', function () {
    Exceptions::fake();

    $service = app()->make(WeatherServiceContract::class);
    $service->search('InvalidLocation12345');

    Exceptions::assertReported(RequestException::class);
})->throws(RequestException::class);
