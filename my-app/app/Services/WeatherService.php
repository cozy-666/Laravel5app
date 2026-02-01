<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function fetchWeatherData($latitude, $longitude)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'current' =>'temperature_2m,wind_speed_10m',
            'hourly' => 'temperature_2m',
            'timezone' => 'Asia/Tokyo',
        ]);
        if($response->failed()){
            throw new \Exception('Failed to fetch weather data');
        }
        return $response->json();
    }
}