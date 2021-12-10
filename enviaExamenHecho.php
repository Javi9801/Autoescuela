<?php


include_once("cargadores/cargarHelper.php");
include_once("cargadores/cargarEntidades.php");
$obj = new stdClass();
BD::conecta();

sesion::iniciar();
$u = sesion::leer('usuario');


if(isset($_POST["preguntas_respuestas"])){

    $p = $_POST["preguntas_respuestas"];
    $id = $_POST["idExamen"];

    $a = json_decode($p, true);

    $examen = BD::obtieneExamen($id);


    BD::altaExamenHecho($examen, $u, "Now()", 3, $p);


    $obj->respuesta = true;
  } else {
    $obj->respuesta = false;
}

    echo json_encode($obj);