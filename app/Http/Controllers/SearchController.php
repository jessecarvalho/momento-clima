<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchByCity(Request $request)
    {
        try{
            $city = $request->search;
            $apiKeyWheater = "05413c5fd1ac43b1e7174f2f0ef85b18";
            $apiWeather = "api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&appid=" . $apiKeyWheater;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $apiWeather);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $response = json_decode($response);
            curl_close($ch);
            $lat = $response->coord->lat;
            $lon = $response->coord->lon;
            $country = $response->sys->country;
            var_dump($lat, $lon);
            $apiWeather = "api.openweathermap.org/data/2.5/onecall?lat=" . $lat ."&lon=" . $lon ."&lang=pt_br&exclude=hourly&units=metric&appid=" . $apiKeyWheater;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $apiWeather);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            return view('weather', ['data' => json_decode($response), 'city' => $city]);
        }
        catch (\Exception $e) {
            return view('error');
        }
    }
}
