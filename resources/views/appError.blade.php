@extends('master.layout')

@section('content')

    <?php
        echo '<div id="error" class="text-center">';
            echo '<h1>Oooops, tivemos um problema</h1>';
            echo '<h2> Por favor, envie o código abaixo para nossa equipe de desenvolvimento, obrigado! ';
            echo '<h3> Error:' . $exception[0] . '</h3>';
            echo '<h3> File:' . $exception[1] . '</h3>';
            echo '<h3> line: ' . $exception[2] . '</h3>';
        echo '</div>';
    ?>
@endsection
