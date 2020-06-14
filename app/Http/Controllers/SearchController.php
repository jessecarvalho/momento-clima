<?php

namespace App\Http\Controllers;

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Http\Request;

class SearchController extends Controller
{

<<<<<<< HEAD
    public function findCoords($api, $id)
=======
    public function shared($api, $apiKey)
>>>>>>> parent of c699c5c... 1.0.6
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
<<<<<<< HEAD
            $response = $this->findCoords($apiWeather, $id);
=======
            $response = $this->shared($apiWeather, $apiKeyWheater);
>>>>>>> parent of c699c5c... 1.0.6
            return view('weather', ['data' => json_decode($response[0]), 'city' => $response[1]]);
        }
        catch (\Exception $e) {
            return view('error');
        }
    }

    public function advancedSearch(Request $request)
    {
<<<<<<< HEAD
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
=======
        $list = "http://localhost/Momento-Clima/public/city.list.json";
        $strJsonFileContents = file_get_contents($list);
        $array = json_decode($strJsonFileContents);
        $target = array();
        $a = ucwords($request->search);
        for ($i = 0; $i < sizeof($array); $i++){
            if ($array[$i]->name == iconv('UTF-8', 'ASCII//TRANSLIT', $a)){
                if (!in_array($array[$i]->name, $target)) {
                   $target[] = $array[$i];
>>>>>>> parent of c699c5c... 1.0.6
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
    public function tirarAcentos($string){
        $string =  preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
        $char = array(' & ', 'ª ', '  (', ') ', '(', ')', ' - ', ' / ', ' /', '/ ', '/', ' | ', ' |', '| ', ' | ', '|', '_', '.', ' ');
        return strtolower(str_replace($char, '-', $string));

    }

}
