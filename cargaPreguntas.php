<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");
BD::conecta();

if(BD::obtienePreguntasJSON()!=null){
    echo BD::obtienePreguntasJSON();
    return true;

} else {
    return false;
}