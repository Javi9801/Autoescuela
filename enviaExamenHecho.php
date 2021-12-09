<?php


include_once("cargadores/cargarHelper.php");
include_once("cargadores/cargarEntidades.php");
$obj = new stdClass();
BD::conecta();

if(isset($_POST["preguntas_respuestas"])){

    $p = $_POST["preguntas_respuestas"];
    $id = $_POST["idFinal"];

    BD::altaExamenHecho($examen, $u, "Now()", 3, $p);


      $obj->respuesta = true;
    } else {
      $obj->respuesta = false;
    }

    echo json_encode($obj);