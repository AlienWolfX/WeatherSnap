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
        $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey";

        $client = new Client();
        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody(), true);

        return view('info', ['data' => $data], compact('city'));
    }
}
