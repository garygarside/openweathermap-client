<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::post('/weather/fetch', [WeatherController::class, 'fetch'])->name('weather.fetch');
