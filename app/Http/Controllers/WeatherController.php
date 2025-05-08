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

        $apiKey = env('OPENWEATHERMAP_API_KEY');
        if (!$apiKey) {
            $errorMessage = 'API key not found. Please set it in your .env file.';
            return view('info', compact('errorMessage', 'city'));
        }
        $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";

        $client = new Client();

        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody(), true);

            if (isset($data['main'])) {
                return view('info', compact('data', 'city'));
            } else {
                $errorMessage = 'City not found';
                dd($errorMessage);
                return view('info', compact('errorMessage', 'city'));
            }
        } catch (\Exception $e) {
            $errorMessage = 'Failed to fetch weather data. Please try again later.';
            return view('info', compact('errorMessage', 'city'));
        }
    }
}
