<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SystemHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function findCoords($api)
    {
        try {
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
        } catch (\Exception $exception){
            return view("appError", ["exception" => [$exception->getMessage(), $exception->getFile(), $exception->getLine()]]);
        }
    }

    //pega dados de previsão a partir de latitude e longitude
    public function findForecastCity($lat, $lon, $city = null)
    {
        try {
            $apiWeather = "api.openweathermap.org/data/2.5/onecall?lat=" . $lat . "&lon=" . $lon . "&lang=pt_br&exclude=hourly&units=metric&appid=" . env("API_OPEN_WEATHER");
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
        }catch (\Exception $exception){
            return view("appError", ["exception" => [$exception->getMessage(), $exception->getFile(), $exception->getLine()]]);
        }
    }


    //Pega dados de previsão a partir do nome da cidade
    public function searchByCity(Request $request)
    {
        try {
            $city = $request->search;
            $apiKeyWheater = env("API_OPEN_WEATHER");
            $apiWeather = "api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&appid=" . $apiKeyWheater;
            $response = $this->findCoords($apiWeather);

            if ($response[1] ?? false) {
                return view('weather', ['data' => json_decode($response[0]), 'city' => $response[1]]);
            }

            return $this->searchCities($city);
        } catch (\Exception $e) {
            return view('error');
        }
    }


    public function searchById(Request $request)
    {
        try {
            $key = "key" . $request->id;
            try {
                $cache = \cache()->remember($key, 60 * 10, function () use ($request) {
                    $id = $request->id;
                    $apiKeyWheater = env("API_OPEN_WEATHER");
                    $apiWeather = "api.openweathermap.org/data/2.5/weather?id=" . $id . "&units=metric&appid=" . $apiKeyWheater;
                    $response = $this->findCoords($apiWeather);
                    return $response;
                });
            } catch (\Exception $e) {
                return view('error');
            }

            return view('weather', ['data' => json_decode($cache[0]), 'city' => $cache[1]]);
        } catch (\Exception $exception){
            return view("appError", ["exception" => [$exception->getMessage(), $exception->getFile(), $exception->getLine()]]);
        }
    }

    public function searchByIp()
    {
        try {
            $ipInfo = geoip($ip = "187.22.132.146");
            $key = $ipInfo->city . $ipInfo->state;
            $cache = \cache()->remember($key, 60*10, function () use ($ipInfo){
                $data = $this->findForecastCity($ipInfo->lat, $ipInfo->lon, $ipInfo->city);
                return $data;
            });
            return view('welcome', ['data' => json_decode($cache[0]), 'city' => $cache[1]]);
        } catch (\Exception $exception){
            return view("appError", ["exception" => [$exception->getMessage(), $exception->getFile(), $exception->getLine()]]);
        }

    }


    public function advancedSearch(Request $request)
    {
        try {
            $request->search = SystemHelper::tirarAcentos($request->search);
            $key = "key" . (strtolower($request->search));
            $cache = \cache()->remember($key, 60*60*24*7, function () use ($request){
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
                    if (SystemHelper::tirarAcentos($array[$i]->name) == (SystemHelper::tirarAcentos(ucwords($request->search)))){
                        if (!in_array($array[$i]->name, $target)) {
                            $target[] = $array[$i];
                        }
                    }
                }
                return $target;
            });
            if (!empty($cache)){
                return view('search', ['data' => $cache]);
            }
            else{
                return view('error');
            }
        }catch (\Exception $exception){
            return view("appError", ["exception" => [$exception->getMessage(), $exception->getFile(), $exception->getLine()]]);
        }


    }

}
