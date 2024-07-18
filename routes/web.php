<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
// routes/web.php
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LeagueController;

Route::get('countries', [CountryController::class, 'index']);
Route::get('countries/{country}', [CountryController::class, 'show']); // Ruta para mostrar las ligas por país
Route::get('countries/{country}/leagues', [LeagueController::class, 'getByCountry']);
Route::get('leagues/{league}/matches', [LeagueController::class, 'getMatches']);
Route::post('populate/leagues', [LeagueController::class, 'populateLeagues']);
Route::post('populate/leagues/{league}/matches', [LeagueController::class, 'populateMatches']);


