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
    <style>
        body {
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            background-image: url('{{ asset('img/background-image.jpg') }}');
            /* Remove the space after 'asset(' */
            background-size: cover;
            background-position: center;
        }

        .form-control::placeholder {
            color: white;
            /* Warning color, adjust as needed */
        }

        /*--------------------------------------------------------------
        # Weather Card
        --------------------------------------------------------------*/
        .weather__card {
            width: 800px;
            padding: 40px 30px;
            background-color: #ad9a61;
            border-radius: 20px;
            color: #3C4048;
        }

        .weather__card h2 {
            font-size: 90px;
            font-weight: 700;
            color: #3C4048;
            line-height: .8;
        }

        .weather__card h3 {
            font-size: 40px;
            font-weight: 600;
            line-height: .8;
            color: #3C4048;
        }

        .weather__card h5 {
            font-size: 20px;
            font-weight: 400;
            line-height: .1;
            color: #9D9D9D;
        }

        .weather__card img {
            width: 120px;
            height: 120px;
        }

        .weather__card .weather__description {
            background-color: #fff;
            border-radius: 25px;
            padding: 5px 13px;
            border: 0;
            outline: none;
            color: #7F8487;
            font-size: .956rem;
            font-weight: 400;
        }

        /*--------------------------------------------------------------
        # Weather Status
        --------------------------------------------------------------*/
        .weather__status img {
            height: 20px;
            width: 20px;
            vertical-align: middle;
        }

        .weather__status span {
            font-weight: 500;
            color: #3C4048;
            font-size: .9rem;
            padding-left: .5rem;
        }

        /* .container {
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
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group button {
            padding: 10px 20px;
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
        } */
    </style>
</head>

<body>
    <!--navbar-->
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="WeatherSnap" width="170">
            </a>
            <div class="bg-warning rounded">
                <h3 id="clock" class="fw-bold px-2 text-center text-white pt-2"></h3>
            </div>
        </div>
    </nav>
    <!--end of navbar-->

    <!--main content-->
    <div class="container mt-5">
        <div class="app-name pt-5">
            <h1 class="text-center text-white fw-bold pt-5"><span class="text-warning">W</span>eather<span
                    class="text-warning">S</span>nap</h1>
            <p class="text-center text-white">
                WeatherSnap is a modern and user-friendly weather application that provides real-time weather
                information at your fingertips.</p>
        </div>

        <div class="get-weather align-items-center justify-content-center">
            <form method="POST" action="{{ route('get-weather') }}" class="form-inline justify-content-center mt-5">
                @csrf
                <div class="form-group mr-2 mt-4">
                    <input type="text" name="city" class="form-control text-white bg-transparent border-warning"
                        placeholder="Enter the location" required>
                </div>
                <button type="submit" class="btn btn-warning mt-4"><i
                        class="fas fa-search weather-icon text-white"></i></button>
            </form>
        </div>

        @isset($data)
        <!-- Weather -->
        <div class="container mt-5">
            <div class="d-flex flex-row justify-content-center align-items-center">
                @if (isset($data['main']))
                <div class="weather__card">
                    <div class="d-flex flex-row justify-content-center align-items-center">
                        <div class="p-3">
                            <h2>{{ $data['main']['temp'] }}&deg;</h2>
                        </div>
                        <div class="p-3">
                            @if (isset($data['weather'][0]['icon']))
                                <img src="https://openweathermap.org/img/wn/{{ $data['weather'][0]['icon'] }}@2x.png"
                            alt="Weather Icon">
                            @endif
                        </div>
                        <div class="p-3">
                            <h3>{{ $data['name'] }},
                                {{ $data['sys']['country'] }}</h3>
                            <span class="weather__description">{{ $data['weather'][0]['description'] }}</span>
                        </div>
                    </div>
                    <div class="weather__status d-flex flex-row justify-content-center align-items-center mt-3">
                        <div class="p-4 d-flex justify-content-center align-items-center">
                            <img src="https://svgur.com/i/oHw.svg">
                            <span>{{ $data['main']['humidity'] }}%</span>
                        </div>
                        <div class="p-4 d-flex justify-content-center align-items-center">
                            <img src="https://svgur.com/i/oKS.svg">
                            <span>{{ $data['wind']['speed'] }} m/s</span>
                        </div>
                    </div>
                </div>
                @else
                    <p class="error-message">No data found for the specified city.</p>
                @endif
            </div>
        </div>
        @endisset

        @if (isset($data['weather'][0]['description']))
                <!--this is for dynamically change the icon base on its description-->
                <?php
                    $iconMappings = [
                    'clear sky' => '01',
                    'few clouds' => '02',
                    'scattered clouds' => '03',
                    'broken clouds' => '04',
                    'shower rain' => '09',
                    'rain' => '10',
                    'thunderstorm' => '11',
                    'snow' => '13',
                    'mist' => '50'
                    ];

                    // <!--lowercase the description-->
                    $lowercaseDescription = strtolower($data['weather'][0]['description']);

                    // <!--check the time, 5AM to 5PM is considered day-->
                    $isDay = date('H') >= 5 && date('H') < 17;

                    // <!--Construct the icon code with the appropriate suffix ('d' for day, 'n' for night)-->
                    $iconCode = $iconMappings[$lowercaseDescription] ?? null;
                    $iconCode .=$isDay ? 'd' : 'n' ;

                ?>
            @endif
                <!-- Display the icon if a mapping exists -->
                @if (isset($iconCode))
                    <img src="https://openweathermap.org/img/wn/{{ $iconCode }}@2x.png" alt='Weather Icon' width='35%'>
                @endif

    </div>
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

