<?php
    require_once("cargadores/cargarHelper.php");
    require_once("cargadores/cargarEntidades.php");
    BD::conecta();
    $pregunta = BD::obtienePregunta($_GET['idPregunta']);

    if(BD::compruebaExamenPregunta($_GET['id_pregunta'])==false){
        BD::eliminaPregunta($_GET['idPregunta']);
    }


    ?>