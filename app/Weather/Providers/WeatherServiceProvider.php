<?php

namespace Weather\Providers;

use Illuminate\Support\ServiceProvider;
use Weather\Contracts\WeatherServiceContract;
use Weather\Services\OpenWeatherService;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WeatherServiceContract::class, function () {
            return new OpenWeatherService(config('services.openweather.api_key'));
        });
    }
}
