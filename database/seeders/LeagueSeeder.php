<?php
// database/seeders/LeagueSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\League;
use App\Models\Country;

class LeagueSeeder extends Seeder
{
    public function run()
    {
        $england = Country::where('name', 'England')->first();
        $germany = Country::where('name', 'Germany')->first();
        $spain = Country::where('name', 'Spain')->first();

        $leagues = [
            ['name' => 'Premier League', 'country_id' => $england->id],
            ['name' => 'Bundesliga', 'country_id' => $germany->id],
            ['name' => 'La Liga', 'country_id' => $spain->id]
        ];

        foreach ($leagues as $league) {
            League::create($league);
        }
    }
}
