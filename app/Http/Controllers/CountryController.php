<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('countries', ['countries' => $countries]);
    }

    public function show($id)
    {
        $country = Country::with('leagues')->findOrFail($id);
        return view('country_leagues', ['country' => $country]);
    }
}
