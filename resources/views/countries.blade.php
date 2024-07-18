<!-- resources/views/countries.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries</title>
</head>
<body>
    <h1>Countries</h1>
    <ul>
        @foreach ($countries as $country)
            <li>
                <a href="{{ url('countries/' . $country->id) }}">{{ $country->name }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
