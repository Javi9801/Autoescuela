<?php

include_once("cargadores/cargarHelper.php");
include_once("cargadores/cargarEntidades.php");
$obj = new stdClass();
BD::conecta();

if(isset($_POST["descripcion"]) && isset($_POST["duracion"]) && isset($_POST["n_preguntas"])){


    $desc = $_POST["descripcion"];

    $e = new Examen($_POST["descripcion"], 4,$_POST["duracion"], 1);
    BD::altaExamen($e);

    $e->id = BD::ultimoIdInsertado("Autoescuela.examen");

    $arr = $_POST["preguntas"];

    $obj->respuesta = true;
    } else {
      $obj->respuesta = false;
    }

    echo json_encode($obj);

