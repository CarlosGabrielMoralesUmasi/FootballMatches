<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\FootballMatchController;

Route::get('countries', [CountryController::class, 'index']);
Route::get('countries/{country}/leagues', [LeagueController::class, 'getByCountry']);
Route::get('leagues/{league}/matches', [FootballMatchController::class, 'getByLeague']);

