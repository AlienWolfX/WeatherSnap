<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
</head>
<body>
    <h1>Weather App</h1>

    <form method="POST" action="{{ route('get-weather') }}">
        @csrf
        <label for="city">Enter City:</label>
        <input type="text" name="city" required>
        <button type="submit">Get Weather</button>
    </form>

    @isset($data)
        @if(isset($data['main']))
            <h2>Weather in {{ $data['name'] }}, {{ $data['sys']['country'] }}</h2>
            <p>Temperature: {{ $data['main']['temp'] }}&deg;C</p>
            <p>Weather: {{ $data['weather'][0]['description'] }}</p>
        @else
            <p>No data found for the specified city.</p>
        @endif
    @endisset
</body>
</html>
