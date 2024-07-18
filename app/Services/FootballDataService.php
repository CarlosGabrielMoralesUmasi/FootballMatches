<?php
// app/Services/FootballDataService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class FootballDataService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('FOOTBALL_DATA_API_KEY');
    }

    public function getLeagues()
    {
        $response = Http::withHeaders([
            'X-Auth-Token' => $this->apiKey,
        ])->withoutVerifying()->get('https://api.football-data.org/v2/competitions');

        return $response->json();
    }

    public function getMatches($leagueId, $startDate, $endDate)
    {
        $response = Http::withHeaders([
            'X-Auth-Token' => $this->apiKey,
        ])->withoutVerifying()->get("https://api.football-data.org/v2/competitions/{$leagueId}/matches", [
            'dateFrom' => $startDate,
            'dateTo' => $endDate,
        ]);

        return $response->json();
    }
}
