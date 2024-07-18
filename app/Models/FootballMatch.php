<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballMatch extends Model
{
    use HasFactory;

    protected $fillable = ['home_team', 'away_team', 'match_date', 'league_id'];

    public function league()
    {
        return $this->belongsTo(League::class);
    }
}
