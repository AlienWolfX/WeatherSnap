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
            color: white;
            /* Warning color, adjust as needed */
        }

        .info-container {
            background-color: rgba(255, 193, 7, 0.5);
            border-radius: 15px;
        }

        .color-line {
            border-color: white;
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
    <div class="get-weather align-items-center justify-content-center mt-5">
        <form method="POST" action="{{ route('get-weather') }}" class="form-inline justify-content-center" autocomplete="off">
            @csrf
            <div class="form-group mr-2 mt-4">
                <input type="text" name="city" class="form-control text-white bg-transparent border-warning" value="{{ $city }}" placeholder="Enter the city" required>
            </div>
            <button type="submit" class="btn btn-warning mt-4"><i class="fas fa-search weather-icon text-white"></i></button>
        </form>
    </div>
    <!--end of search bar-->
    @isset($errorMessage)
    <div class="row mx-auto container info-container mt-5">
        <div class="col text-center text-white">
            <img src="{{ asset('img/not_found_icon.png')}}" alt="" class="w-25">
            <h2 class="pb-3">City not found</h2>
        </div>
    </div>
    @endisset

    @isset($data)
    <div class="row mx-auto container info-container mt-5">
        @if (isset($data['main']))
        <div class="col text-center">
            @if (isset($data['weather'][0]['icon']))
            <img src="https://openweathermap.org/img/wn/{{ $data['weather'][0]['icon'] }}@2x.png" alt="Weather Icon">
            @endif
            <h1 class="text-white">{{ $data['main']['temp'] }} &deg;C</h1>
            <h2 class="text-white">{{ $data['weather'][0]['description'] }}</h2>
            <hr class="color-line w-75" />
            <h2 class="text-white pt-4 pb-4">{{ $data['name'] }}, {{ $data['sys']['country'] }}</h2>
        </div>
        <div class="col d-flex align-items-center justify-content-center">
            <div class="row text-white text-center">
                <div class="col mx-3 mt-2 w-50">
                    <img src="{{ asset('img/humidity_icon.png')}}" alt="" class="w-75">
                    <p>Humidity</p>
                    <h3 class="pt-3">{{ $data['main']['humidity'] }}%</h3>

                </div>
                <div class="col mx-3 px-2 mt-2 w-50">
                    <img src="{{ asset('img/air_pressure_icon.png')}}" alt="" class="w-75">
                    <p>Air Pressure</p>
                    <h3 class="pt-3">{{ $data['main']['pressure'] }} hPa</h3>
                </div>
                <div class="col mx-3 px-2 mt-2">
                    <img src="{{ asset('img/wind_speed_icon.png')}}" alt="" class="w-75">
                    <p>Wind Speed</p>
                    <h3 class="pt-3">{{ $data['wind']['speed'] }} m/s</h3>
                </div>
            </div>
        </div>
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