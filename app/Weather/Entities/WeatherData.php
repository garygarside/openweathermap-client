<?php

namespace Weather\Entities;

class WeatherData
{
    public const KEY_TEMPERATURE = 1;
    public const KEY_DESCRIPTION = 12;
    public const KEY_HUMIDITY = 8;
    public const KEY_WIND_SPEED = 15;
    public const KEY_WIND_DIRECTION = 16;

    public function __construct(
        private float $temperature,
        private string $description,
        private float $humidity,
        private string $windSpeed,
        private string $windDirection,
    ) {
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getHumidity(): float
    {
        return $this->humidity;
    }

    public function getWindSpeed(): string
    {
        return $this->windSpeed;
    }

    public function getWindDirection(): string
    {
        return $this->windDirection;
    }

    public function toArray(): array
    {
        return [
            'temperature' => $this->getTemperature(),
            'description' => $this->getDescription(),
            'humidity' => $this->getHumidity(),
            'wind_speed' => $this->getWindSpeed(),
            'wind_direction' => $this->getWindDirection(),
        ];
    }
}
