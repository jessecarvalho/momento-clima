<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SystemHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function findCoords($api, $id)
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
        $array = $this->findForecastCity($lat, $lon, $city);
        return $array;
    }

    public function findForecastCity($lat, $lon, $city = null)
    {
        $apiWeather = "api.openweathermap.org/data/2.5/onecall?lat=" . $lat ."&lon=" . $lon ."&lang=pt_br&exclude=hourly&units=metric&appid=" . env("API_OPEN_WEATHER");
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
            $apiKeyWheater = env("API_OPEN_WEATHER");
            $apiWeather = "api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&appid=" . $apiKeyWheater;
            $response = $this->findCoords($apiWeather);

            if ($response[1] ?? false) {
                return view('weather', ['data' => json_decode($response[0]), 'city' => $response[1]]);
            }

            return $this->searchCities($city);
        }
        catch (\Exception $e) {
            return view('error');
        }
    }

    public function searchById(Request $request)
    {
        try{
            $id = $request->id;
            $apiKeyWheater = env("API_OPEN_WEATHER");
            $apiWeather = "api.openweathermap.org/data/2.5/weather?id=" . $id . "&units=metric&appid=" . $apiKeyWheater;
            $response = $this->findCoords($apiWeather, $id);
            return view('weather', ['data' => json_decode($response[0]), 'city' => $response[1]]);
       }
        catch (\Exception $e) {
            return view('error');
        }
    }

    public function searchByIp()
    {
        $ipInfo = geoip($ip = "null");
        $data = $this->findForecastCity($ipInfo->lat, $ipInfo->lon, $ipInfo->city);
        return view('welcome', ['data' => json_decode($data[0]), 'city' => $data[1]]);
    }


    public function advancedSearch(Request $request)
    {
    var_dump(\cache()->get("a"));
        $city = \cache()->remember("a", 60*10, function () {
            $apiWeather = env("JSON_LIST");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $apiWeather);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            $array = json_decode($response);
            $target = array();
            for ($i = 0; $i < sizeof($array); $i++){
                if (SystemHelper::tirarAcentos($array[$i]->name) == (SystemHelper::tirarAcentos(ucwords("Guarulhos")))){
                    if (!in_array($array[$i]->name, $target)) {
                        $target[] = $array[$i];
                    }
                }
            }
            return $target;
        });
        if (!empty($city)){
            return view('search', ['data' => $city]);
        }
        else{
            return view('error');
        }

    }

}
