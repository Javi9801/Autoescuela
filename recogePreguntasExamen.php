<?php

require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");
BD::conecta();

if(BD::obtienePreguntasExamen($_GET['idExamen'])!=null){

    $n =BD::obtienePreguntasExamen($_GET['idExamen']);

    for($i=0; $i<count($n);$i++){
        $r = BD::obtieneRespuestas($n[$i]->id);
        $n[$i]->respuestas = $r;
    }
    $pre = json_encode($n);

    echo($pre);

    return true;
} else {
    return false;
}