@extends('master.layout')
@section('content')
    <img src="http://localhost/Momento-Clima/public/img/logo.png" id="logo">
    <div class="search">
        <form class="form-inline my-2 my-lg-0" action="<?= route("clima") ?>" method="post">
            @csrf
            <input class="form-control mr-sm-2" type="search" autocomplete="off" placeholder="Pesquise uma cidade" aria-label="Search" name="search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
    </div>
    <div id="info">
    <h1>Para começar digite o nome da cidade desejada no mecanismo de busca acima.</h1>
    </div>
@endsection
