@extends('master.layout')
@section('content')
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

    <div class="advice">
        <h1>Se o resultado não for o desejado tente refazer a pesquisa com o nome da cidade em inglês</h1>
    </div>

    <?php
    for ($i = 0; $i < sizeof($data); $i++){
        echo "<a href='" . route("searchById", ['id' => $data[0]->id]) . " '>";
            echo "<div class='search_result'>";
                echo "<h1>" . $data[$i]->name . ", " . $data[$i]->country . " <img src='https://openweathermap.org/images/flags/" . strtolower($data[$i]->country) . ".png'></h1>";
                echo "<h2>Latitude: " . $data[$i]->coord->lat . " longitude: " . $data[$i]->coord->lon . "</h2>";
            echo "</div>";
        echo "</a>";
    }
    ?>

@endsection
