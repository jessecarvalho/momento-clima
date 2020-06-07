@extends('master.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="currentWeather">
                    <img src="http://localhost/Momento-Clima/public/img/<?=$data->daily[0]->weather[0]->icon?>.png" class="imgWeatherMaster">
                    <div class="infoWeather">
                        <h1><?=intVal($data->daily[0]->temp->day)?>ºc</h1>
                        <h2><?=$data->daily[0]->weather[0]->description?> em <?=$city?></h2>
                        <h2>Sensação térmica: <?=intVal($data->daily[0]->feels_like->day)?>ºc</h2>
                        <h2>Humidade: <?=intVal($data->daily[0]->humidity)?>%</h2>
                    </div>
                <div id="search">
                    <form class="form-inline my-2 my-lg-0" action="<?= route("city") ?>" method="post">
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
            <?php date_default_timezone_set('America/Sao_Paulo');
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            ?>
            <div class="col-2"></div>
            <div class="col-8 div-weather">
                <div class="row">
                    <div class="col-3 sub-div-weather">
                        <img src="http://localhost/Momento-Clima/public/img/<?=$data->daily[1]->weather[0]->icon?>.png" class="imgWeather">
                        <h2><?=date("j, n, Y");?></h2>
                        <h1><?=intVal($data->daily[1]->temp->day)?>º</h1>
                        <h3>min: <?=intVal($data->daily[1]->temp->min)?>º | max: <?=intVal($data->daily[1]->temp->max)?>º</h3>
                    </div>
                    <div class="col-3 sub-div-weather">
                        <img src="http://localhost/Momento-Clima/public/img/<?=$data->daily[2]->weather[0]->icon?>.png" class="imgWeather">
                        <h2><?=date("j, n, Y", time() + 86400);?></h2>
                        <h1><?=intVal($data->daily[2]->temp->day)?>º</h1>
                        <h3>min: <?=intVal($data->daily[2]->temp->min)?>º | max: <?=intVal($data->daily[2]->temp->max)?>º</h3>
                    </div>
                    <div class="col-3 sub-div-weather">
                        <img src="http://localhost/Momento-Clima/public/img/<?=$data->daily[3]->weather[0]->icon?>.png" class="imgWeather">
                        <h2><?=date("j, n, Y", time() + 172800)?></h2>
                        <h1><?=intVal($data->daily[3]->temp->day)?>º</h1>
                        <h3>min: <?=intVal($data->daily[3]->temp->min)?>º | max: <?=intVal($data->daily[3]->temp->max)?>º</h3>
                    </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection()
