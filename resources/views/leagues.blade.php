<!-- resources/views/leagues.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leagues in {{ $country->name }}</title>
</head>
<body>
    <h1>Leagues in {{ $country->name }}</h1>
    <ul>
        @foreach ($leagues as $league)
            <li>
                <a href="{{ url('leagues/' . $league->id . '/matches') }}">{{ $league->name }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
