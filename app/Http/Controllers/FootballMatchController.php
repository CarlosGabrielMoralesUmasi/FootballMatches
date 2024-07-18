<?php

namespace App\Http\Controllers;

use App\Models\FootballMatch;
use App\Models\League;
use App\Services\FootballDataService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FootballMatchController extends Controller
{
    protected $footballDataService;

    public function __construct(FootballDataService $footballDataService)
    {
        $this->footballDataService = $footballDataService;
    }

    public function getByLeague($leagueId, Request $request)
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

    public function populateMatches($leagueId)
    {
        $startDate = Carbon::today()->toDateString();
        $endDate = Carbon::today()->addDays(2)->toDateString();
        $matches = $this->footballDataService->getMatches($leagueId, $startDate, $endDate);
    
        dd($matches); // Agrega esta línea para verificar la respuesta
    
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
