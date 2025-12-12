<?php

use Weather\Entities\Location;

test('test that we can create a new Location entity', function () {
    $location = new Location(
        name: 'Nuneaton',
        state: 'England'
    );

    expect($location)->toBeInstanceOf(Location::class);
});

test('test that Location entity getters work correctly', function () {
    $location = new Location(
        name: 'Nuneaton',
        state: 'England'
    );

    expect($location)->toBeInstanceOf(Location::class);
    expect($location->getName())->toBe('Nuneaton');
    expect($location->getCountry())->toBe('United Kingdom');
    expect($location->getState())->toBe('England');
});

test('test that Location entity toArray method works correctly', function () {
    $location = new Location(
        name: 'Nuneaton',
        state: 'England'
    );

    $array = $location->toArray();
    expect($array)->toBe([
        'name' => 'Nuneaton',
        'country' => 'United Kingdom',
        'state' => 'England',
    ]);
});
