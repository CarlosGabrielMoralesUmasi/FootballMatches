<?php

// app/Http/Controllers/LeagueController.php
namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\League;
use App\Models\FootballMatch;
use App\Services\FootballDataService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeagueController extends Controller
{
    protected $footballDataService;

    public function __construct(FootballDataService $footballDataService)
    {
        $this->footballDataService = $footballDataService;
    }

    public function getByCountry($countryId)
    {
        $country = Country::findOrFail($countryId);
        $leagues = League::where('country_id', $countryId)->get();
        return view('leagues', compact('leagues', 'country'));
    }

    public function getMatches($leagueId, Request $request)
    {
        $league = League::findOrFail($leagueId);

        $date = $request->input('date', Carbon::today()->toDateString());
        $startDate = Carbon::parse($date)->toDateString();
        $endDate = Carbon::parse($date)->addDays(2)->toDateString();

        $matches = FootballMatch::where('league_id', $leagueId)
            ->whereBetween('match_date', [$startDate, $endDate])
            ->get();

        return view('matches', compact('matches', 'league', 'startDate', 'endDate'));
    }

    public function populateLeagues()
    {
        $leagues = $this->footballDataService->getLeagues();
        foreach ($leagues['competitions'] as $league) {
            $country = Country::firstOrCreate(['name' => $league['area']['name']]);
            League::updateOrCreate([
                'id' => $league['id'],
            ], [
                'name' => $league['name'],
                'country_id' => $country->id,
            ]);
        }

        return response()->json(['message' => 'Leagues populated successfully']);
    }

    public function populateMatches($leagueId)
    {
        $matches = $this->footballDataService->getMatches($leagueId, Carbon::today()->toDateString(), Carbon::today()->addDays(2)->toDateString());
        foreach ($matches['matches'] as $match) {
            FootballMatch::updateOrCreate([
                'id' => $match['id'],
            ], [
                'home_team' => $match['homeTeam']['name'],
                'away_team' => $match['awayTeam']['name'],
                'match_date' => $match['utcDate'],
                'league_id' => $leagueId,
            ]);
        }

        return response()->json(['message' => 'Matches populated successfully']);
    }
}
