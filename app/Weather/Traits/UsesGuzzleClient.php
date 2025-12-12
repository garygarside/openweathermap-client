<?php

namespace Weather\Traits;

use GuzzleHttp\Client;

trait UsesGuzzleClient
{
    private Client $client;

    public function __construct(private string $apiKey)
    {
        $this->client = $this->client();
    }

    public function client(): Client
    {
        return new Client([
            'base_uri' => $this->base_uri,
            'timeout'  => 5.0,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
