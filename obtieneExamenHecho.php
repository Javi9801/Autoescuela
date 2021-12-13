<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");
BD::conecta();

if(BD::obtieneIdExamenHecho($_GET['idExamen'])!=null){

    $respuestas=BD::obtieneIdExamenHecho($_GET['idExamen']);

    $pre = json_encode($respuestas);

    echo($pre);

    return true;
} else {
    return false;
}