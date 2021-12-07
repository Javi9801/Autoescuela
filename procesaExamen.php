<?php

include_once("cargadores/cargarHelper.php");
include_once("cargadores/cargarEntidades.php");
$obj = new stdClass();
BD::conecta();

if(isset($_POST["descripcion"]) && isset($_POST["duracion"]) && isset($_POST["n_preguntas"])){

    $desc = $_POST["descripcion"];
    $dur = (int)$_POST["duracion"];
    $dur = ($dur*100);
    $npreguntas = (int)$_POST["n_preguntas"];

    $e = new Examen($desc,$npreguntas,$dur, 1);
    BD::altaExamen($e);

    $e->id = BD::ultimoIdInsertado("Autoescuela.examen");
    $preguntas = [];

    $preguntas = explode(",",$_POST["preguntas"]);

    for($i=0; $i<$npreguntas;$i++){
      BD::altaPreguntasExamen($e, $preguntas[$i]);
    }



      $obj->respuesta = true;
    } else {
      $obj->respuesta = false;
    }

    echo json_encode($obj);

