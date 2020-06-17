@extends('master.layout')
@section('content')
    <img src="http://localhost/Momento-Clima/public/img/01d.png" id="logo">


    <div id="switchSearch">
        <button type="button" class="btn btn-primary" onclick="advancedSearch()" id="zipButton">Avançada</button>
        <button type="button" class="btn btn-outline-primary" onclick="basicSearch()" id="cityButton">Rápida</button>
        <h2 id="warning">Cuidado! A pesquisa rápida pode levar a resultados errados</h2>
    </div>
    <div id="basic">
        <form class="form-inline my-2 my-lg-0" action="<?= route("basicSearch") ?>" method="post">
            @csrf
            <input class="form-control mr-sm-2" type="search" autocomplete="off" placeholder="Pesquise uma cidade" aria-label="Search" name="search">
            <button class="btn btn-search btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
    </div>
    <div id="advanced">
        <form class="form-inline my-2 my-lg-0" action="<?= route("advancedSearch") ?>" method="post">
            @csrf
            <input class="form-control mr-sm-2" type="search" autocomplete="off" placeholder="Pesquise uma cidade" aria-label="Search" name="search">
            <button class="btn btn-search btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
    </div>

    <div id="info">
        <h1>Para começar digite o nome da cidade desejada no mecanismo de busca acima.</h1>
    </div>

    <div class="container forecastMainInfo">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                    <div class="infoWeather weatherHome">
                        <h4>O clima na sua cidade:</h4>
                        <h1><?=intVal($data->daily[0]->temp->day)?>ºc</h1>
                        <h2><?=$data->daily[0]->weather[0]->description?> em <?=$city?></h2>
                        <h2>Sensação térmica: <?=intVal($data->daily[0]->feels_like->day)?>ºc</h2>
                        <h2>Humidade: <?=intVal($data->daily[0]->humidity)?>%</h2>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection
