@extends('master.layout')

@section('content')
    <div id="info_abt">
        <h1>About us</h1>
        <h2>Momento clima é um site que oferece previsão de tempo a partir do uso um extenso banco de dados,
            com mais de 200 mil cidades pelo mundo oferecidas por <a href="https://openweathermap.org/">Open Weather Map</a>
            com uma cobertura confiável e de qualidade.
            <br> <br>
            Desenvolvedor: Jessé Carvalho (jesseelias80@gmail.com).<br>
            Icons cedidos gratuitamente por: <a href="https://www.flaticon.com/authors/freepik">Freepik</a><br>
            API de autoria de <a href="https://openweathermap.org/">Open Weather Map</a>.
        </h2>
        <img src= <?=env("ABOUT_IMG")?> id="abt_logo">
    </div>
@endsection
