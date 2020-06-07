@extends('master.layout')
@section('content')

    <img src="http://localhost/Momento-Clima/public/img/01d.png" id="logo">
    <div id="switchSearch">
        <button type="button" class="btn btn-primary" onclick="changeCity()" id="cityButton">cidade</button>
        <button type="button" class="btn btn-outline-primary" onclick="changeZip()" id="zipButton">cep</button>
        <h2 id="warning">Para uma pesquisa com mais confiábilidade escolha CEP</h2>
    </div>
    <div id="city">
        <form class="form-inline my-2 my-lg-0" action="<?= route("city") ?>" method="post">
            @csrf
            <input class="form-control mr-sm-2" type="search" autocomplete="off" placeholder="Pesquise uma cidade" aria-label="Search" name="search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
    </div>

    <div id="zip">
        <form class="form-inline my-2 my-lg-0" action="<?= route("zip") ?>" method="post">
            @csrf
            <input class="form-control mr-sm-2" type="search" autocomplete="off" placeholder="Pesquise um CEP" aria-label="Search" name="search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
    </div>

    <div id="info">
        <h1>Para começar digite o nome da cidade desejada no mecanismo de busca acima.</h1>
    </div>
@endsection
