<?php

namespace Weather\Contracts;

use Illuminate\Support\Collection;
use Weather\Entities\Location;

interface WeatherServiceContract
{
    public function search(string $location): ?Collection;

    public function getByLocation(Location $location): ?Collection;
}
