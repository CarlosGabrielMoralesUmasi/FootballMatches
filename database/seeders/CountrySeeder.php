<?php
// database/seeders/CountrySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'England'],
            ['name' => 'Germany'],
            ['name' => 'Spain']
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
