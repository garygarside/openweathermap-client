<?php

use Inertia\Testing\AssertableInertia as Assert;
use Weather\Entities\Location;

test('test that we can visit the homepage', function () {
    $response = $this->get(route('home'));
    $response->assertStatus(200);
});

test('test that our Inertia component renders', function () {
    $this->get(route('home'))
        ->assertInertia(
            fn (Assert $page) => $page
            ->component('Index')
        );
});

test('test that we can use our fetch API endpoint', function () {
    $location = new Location(
        name: 'London',
    );

    $response = $this->post(route('weather.fetch', [
        'location' => $location->getName(),
    ]))
        ->assertStatus(200)
        ->assertJsonStructure([
            'name',
            'country',
            'data' => [
                'temperature',
                'description',
                'humidity',
                'wind_speed',
                'wind_direction',
            ],
        ]);
});
