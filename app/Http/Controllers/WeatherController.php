<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\LocationRequest;
use Weather\Contracts\WeatherServiceContract;
use Weather\Entities\Location;
use Weather\Resources\LocationResource;

class WeatherController extends Controller
{
    private array $exceptionCodes = [
        'Weather\\Exceptions\\RequestException' => 404,
    ];

    public function index()
    {
        return Inertia::render('Index');
    }

    public function fetch(LocationRequest $request, WeatherServiceContract $weatherService)
    {
        return Cache::remember('fetch_' . md5($request->input('location')), now()->addHours(1), function () use ($request, $weatherService) {
            try {
                $data = $weatherService->search($request->input('location'));
            } catch (\Throwable $e) {
                return response()->json([
                    'message' => 'Failed to fetch weather data for '.$request->input('location'),
                    'exception' => $e->getMessage(),
                    'exception_class' => basename(get_class($e)),
                ], $this->exceptionCodes[get_class($e)] ?? 500);
            }

            $location = new Location(name: $request->input('location'));
            $location->setData($data);

            return new LocationResource($location);
        });
    }
}
