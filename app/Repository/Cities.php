<?php


namespace App\Repository;

use App\City;

class Cities
{
    CONST CACHE_KEY = "CITIES";
    public function all($id){
        return cache()->remember($id, 120, function () use($id) {
            return $id->get();
        });
    }

    public function get(){

    }

    public function getCacheKey($key)
    {
        $key = strtoupper($key);
        return self::CACHE_KEY.">$key";
    }
}
