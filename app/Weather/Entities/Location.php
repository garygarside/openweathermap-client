<?php

namespace Weather\Entities;

use Illuminate\Support\Collection;
use Weather\Resources\WeatherDataResource;

class Location
{
    private const COUNTRY = 'United Kingdom';
    private $data;

    public function __construct(
        private string $name,
        private ?string $state = null,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountry(): ?string
    {
        return self::COUNTRY;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setData(Collection $data): void
    {
        $data = $data->flatten()->only([
            WeatherData::KEY_TEMPERATURE,
            WeatherData::KEY_DESCRIPTION,
            WeatherData::KEY_HUMIDITY,
            WeatherData::KEY_WIND_SPEED,
            WeatherData::KEY_WIND_DIRECTION,
        ]);

        $this->data = [
            'temperature' => $data->get(WeatherData::KEY_TEMPERATURE),
            'description' => $data->get(WeatherData::KEY_DESCRIPTION),
            'humidity' => $data->get(WeatherData::KEY_HUMIDITY),
            'wind_speed' => $data->get(WeatherData::KEY_WIND_SPEED),
            'wind_direction' => $data->get(WeatherData::KEY_WIND_DIRECTION),
        ];
    }

    public function getData(): ?array
    {
        return $this->data ?? null;
    }

    public function searchString(): string
    {
        $components = [$this->getName()];

        if ($this->getState()) {
            $components[] = $this->getState();
        }

        $components[] = $this->getCountry();

        return implode(',', $components);
    }

    public function toArray(): array
    {
        $response = [
            'name' => $this->getName(),
            'country' => $this->getCountry(),
        ];

        if ($this->getState()) {
            $response['state'] = $this->getState();
        }

        if ($this->getData()) {
            $response['data'] = new WeatherDataResource(new WeatherData(
                temperature: $this->data['temperature'],
                description: $this->data['description'],
                humidity: $this->data['humidity'],
                windSpeed: $this->data['wind_speed'],
                windDirection: $this->data['wind_direction'],
            ));
        }

        return $response;
    }
}
