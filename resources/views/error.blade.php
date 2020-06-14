@extends('master.layout')
@section('content')
    <img src= <?=env("WRONG_IMG")?> id="logo">
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

    <div id="info-wrong">
        <h1>Ooops, cidade não encontrada, verifique se escreveu corretamente e tente novamente!
        <br>Obs: Algumas cidades estão registradas somente em inglês.</h1>
    </div>
@endsection
