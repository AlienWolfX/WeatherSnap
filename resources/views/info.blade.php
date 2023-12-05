<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherSnap</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!--font Poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!--styles-->
    <style>
        body {
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            background-image: url('{{asset('img/background-image.jpg') }}');
            /* Remove the space after 'asset(' */
            background-size: cover;
            background-position: center;
        }

        .form-control::placeholder {
        color: white; /* Warning color, adjust as needed */
    }
    </style>
</head>
<body>
    <!--navbar-->
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('/') }}">
                <img src="{{ asset('img/logo.png')}}" alt="WeatherSnap" width="170">
            </a>
            <div class="bg-warning rounded">
                <h3 id="clock" class="fw-bold px-2 text-center text-white pt-2"></h3>
            </div>
        </div>
    </nav>
    <!--end of navbar-->

    <!--search bar-->
    <div class="get-weather align-items-center justify-content-center">
            <form method="POST" action="{{ route('get-weather') }}" class="form-inline justify-content-center" autocomplete="off">
                @csrf
                <div class="form-group mr-2 mt-4">
                    <input type="text" name="city" class="form-control text-white bg-transparent border-warning" required>
                </div>
                <button type="submit" class="btn btn-warning mt-4"><i class="fas fa-search weather-icon text-white"></i></button>
            </form>
        </div>
        <!--end of search bar-->
        @isset($data)
        <div class="weather-info">
            @if(isset($data['main']))
            <h2><i class="fas fa-cloud-sun weather-icon"></i> Weather in {{ $data['name'] }}, {{ $data['sys']['country'] }}</h2>
            <p><i class="fas fa-thermometer-half weather-icon"></i> Temperature: {{ $data['main']['temp'] }}&deg;C</p>
            <p><i class="fas fa-tint weather-icon"></i> Humidity: {{ $data['main']['humidity'] }}%</p>
            <p><i class="fas fa-wind weather-icon"></i> Wind Speed: {{ $data['wind']['speed'] }} m/s</p>
            <p><i class="fas fa-cloud weather-icon"></i> Weather: {{ $data['weather'][0]['description'] }}</p>
            @if(strtolower($data['weather'][0]['main']) == 'haze')
            <p class="text-warning"><i class="fas fa-exclamation-triangle weather-icon"></i> Haze Alert!</p>
            @endif
            @else
            <p class="error-message">No data found for the specified city.</p>
            @endif
        </div>
        @endisset

    <!--javascripts-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function updateClock() {
            // Get the current time
            const now = new Date();

            // Extract hours, minutes, and seconds
            let hours = now.getHours();
            const ampm = hours >= 12 ? 'PM' : 'AM';

            // Convert to 12-hour format
            hours = hours % 12 || 12;

            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');

            // Display the time in the 'clock' div
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);

        // Initial update
        updateClock();
    </script>
</body>
</html>