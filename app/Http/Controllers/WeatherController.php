<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather');
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');

        $apiKey = '58e50900422ca0c04fab2e579e29cbb6';
        $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";

        $client = new Client();
        
        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), true);

            // Check if the response is successful
            if (isset($data['main'])) {
                return view('info', compact('data', 'city'));
            } else {
                // Pass the error message to the view
                $errorMessage = 'City not found';
                dd($errorMessage);
                return view('info', compact('errorMessage', 'city'));
            }
        } catch (\Exception $e) {
            // Handle GuzzleHttp exception, for example, connection error
            $errorMessage = 'Failed to fetch weather data. Please try again later.';
            return view('info', compact('errorMessage', 'city'));
        }
    }
}
