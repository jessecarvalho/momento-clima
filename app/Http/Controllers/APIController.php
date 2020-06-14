<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function __invoke($city){
        $apikey = "05413c5fd1ac43b1e7174f2f0ef85b18";
        $api = "api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&appid=" . $apikey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $api);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return view('weather', ['data' => json_decode($response), 'city' => $city]);
    }
}
