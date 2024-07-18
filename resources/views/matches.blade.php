<!-- resources/views/matches.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches in {{ $league->name }}</title>
</head>
<body>
    <h1>Matches in {{ $league->name }}</h1>
    
    <form action="{{ url('leagues/' . $league->id . '/matches') }}" method="GET">
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" value="{{ request('date', Carbon\Carbon::today()->toDateString()) }}">
        <button type="submit">Get Matches</button>
    </form>

    <ul>
        @foreach ($matches as $match)
            <li>
                {{ $match->home_team }} vs {{ $match->away_team }} on {{ $match->match_date }}
            </li>
        @endforeach
    </ul>
    <a href="{{ url('countries/' . $league->country->id . '/leagues') }}">Back to Leagues</a>
</body>
</html>
