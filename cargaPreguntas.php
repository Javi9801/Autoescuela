<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");
BD::conecta();

if(BD::obtienePreguntasJSON()!=null){

    $n = BD::obtienePreguntasJSON();
    $pre = json_encode($n);

    echo($pre);

    return true;
} else {
    return false;
}