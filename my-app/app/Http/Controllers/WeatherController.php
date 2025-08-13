<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use App\Enums\City;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $cityName = $request->input('city', 'Tokyo');
        

        try {
            $city = City::from($cityName);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid City Name'], 400);
        }
        $cityLocation = $city->getCoordinates();

        try {
            $weatherData = $this->weatherService->fetchWeatherData($cityLocation['latitude'], $cityLocation['longitude']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        $cities = City::getAllCities();
        return view('weather.index',['city' => $city, 'cities' => $cities, 'weatherData' => $weatherData]);
    }
}
