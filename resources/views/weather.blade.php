<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .weather-icon {
            font-size: 24px;
            margin-right: 5px;
        }

        .form-group {
            margin-bottom: 10px;
            display: inline-block;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="text"] {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group button {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .weather-info {
            margin-top: 20px;
        }

        .weather-info h2 {
            margin-bottom: 10px;
        }

        .weather-info p {
            margin-bottom: 5px;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="app-name">
            <h1>Weather App</h1>
        </div>

        <div class="get-weather">
            <form method="POST" action="{{ route('get-weather') }}">
                @csrf
                <div class="form-group" style="display: inline-block;">
                    <label for="city">Enter City:</label>
                    <input type="text" name="city" required>
                </div>
                <button type="submit"><i class="fas fa-search weather-icon"></i> Get Weather</button>
            </form>
        </div>

        @isset($data)
            <div class="weather-info">
                @if(isset($data['main']))
                    <h2><i class="fas fa-cloud-sun weather-icon"></i> Weather in {{ $data['name'] }}, {{ $data['sys']['country'] }}</h2>
                    <p><i class="fas fa-thermometer-half weather-icon"></i> Temperature: {{ $data['main']['temp'] }}&deg;C</p>
                    <p><i class="fas fa-cloud weather-icon"></i> Weather: {{ $data['weather'][0]['description'] }}</p>
                @else
                    <p class="error-message">No data found for the specified city.</p>
                @endif
            </div>
        @endisset
    </div>
</body>
</html>
