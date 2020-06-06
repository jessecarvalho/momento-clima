@extends('master.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="currentWeather">
                    <img src="http://localhost/Momento-Clima/public/img/01.png" class="imgWeatherMaster">
                    <div class="infoWeather">
                        <h1><?=intVal($data->main->temp_max)?>º</h1>
                        <h2><?=$data->weather[0]->description?> in <?=$city?></h2>
                    </div>
                <div class="search">
                    <form class="form-inline my-2 my-lg-0" action="<?= route("clima") ?>" method="post">
                        @csrf
                        <input class="form-control mr-sm-2" type="search" autocomplete="off" placeholder="Pesquise outra cidade" aria-label="Search" name="search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
                    </form>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <!---->
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 div-weather">
                <div class="row">
                    <div class="col-3 sub-div-weather">
                        <img src="http://localhost/Momento-Clima/public/img/01.png" class="imgWeather">
                        <h2>Amanha</h2>
                        <h1>34º</h1>
                        <h3>min: 27º | max: 35º</h3>
                    </div>
                    <div class="col-3 sub-div-weather">
                        <img src="http://localhost/Momento-Clima/public/img/02.png" class="imgWeather">
                        <h2>06/06</h2>
                        <h1>22º</h1>
                        <h3>min: 16º | max: 28º</h3>
                    </div>
                    <div class="col-3 sub-div-weather">
                        <img src="http://localhost/Momento-Clima/public/img/02.png" class="imgWeather">
                        <h2>07/06</h2>
                        <h1>28º</h1>
                        <h3>min: 24º | max: 32º</h3>
                    </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection()
