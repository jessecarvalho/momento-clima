<?php

namespace App\Http\Controllers;

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function shared($api, $apiKey)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $api);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $response = json_decode($response);
        curl_close($ch);
        $lat = $response->coord->lat;
        $lon = $response->coord->lon;
        $city = $response->name;
        $apiWeather = "api.openweathermap.org/data/2.5/onecall?lat=" . $lat ."&lon=" . $lon ."&lang=pt_br&exclude=hourly&units=metric&appid=" . $apiKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $apiWeather);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return array($response, $city);
    }

    public function searchByCity(Request $request)
    {
        try{
            $city = $request->search;
            $apiKeyWheater = "05413c5fd1ac43b1e7174f2f0ef85b18";
            $apiWeather = "api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&appid=" . $apiKeyWheater;
            $response = $this->shared($apiWeather, $apiKeyWheater);
            return view('weather', ['data' => json_decode($response[0]), 'city' => $response[1]]);
        }
        catch (\Exception $e) {
            return view('error');
        }
    }

    public function searchById(Request $request)
    {
        try{
            $id = $request->id;
            $apiKeyWheater = "05413c5fd1ac43b1e7174f2f0ef85b18";
            $apiWeather = "api.openweathermap.org/data/2.5/weather?id=" . $id . "&units=metric&appid=" . $apiKeyWheater;
            $response = $this->shared($apiWeather, $apiKeyWheater);
            return view('weather', ['data' => json_decode($response[0]), 'city' => $response[1]]);
        }
        catch (\Exception $e) {
            return view('error');
        }
    }

    public function advancedSearch(Request $request)
    {
        $list = "http://localhost/Momento-Clima/public/city.list.json";
        $strJsonFileContents = file_get_contents($list);
        $array = json_decode($strJsonFileContents);
        $target = array();
        for ($i = 0; $i < sizeof($array); $i++){
            if ($array[$i]->name == ucwords($request->search)){
                if (!in_array($array[$i]->name, $target)) {
                   $target[] = $array[$i];
                }
            }
        }
        if (!empty($target)){
            return view('search', ['data' => $target]);
        }
        else{
            return view('error');
        }
    }
}
