<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/altaMasivaPregunta.js"></script>
</head>
<body>
    <?php include ("includes/nav.php");?>




    <section class="contenido">
        <!-- <input id="fileInput" type="file" size="50" onchange="processFiles(this.files)"> -->
       <section class="altasMasivas">
           <h1>Alta Masiva de Preguntas</h1>
        <textarea placeholder="enunciado;tematica;r1;r2;r3;r4;rCorrecta" id="fileOutput1" rows="20" cols="80"></textarea><br>
        <button id="enviar_archivo_preguntas" value="Enviar">Enviar</button>
       </section>
    </section>
</body>
</html>


<?php

include_once("cargadores/cargarHelper.php");
include_once("cargadores/cargarEntidades.php");
$obj = new stdClass();
BD::conecta();

sesion::iniciar();
$u = sesion::leer('usuario');


if(isset($_POST["preguntas"])){

    $p = $_POST["preguntas"];
    $n_preguntas = $_POST["n_preguntas"];

    $a = json_decode($p, true);


    for($i=0;$i<$n_preguntas;$i++){
        $tematica = BD::obtieneTematica($a[$i][1]);
        $pre = new Pregunta($a[$i][0],"",$tematica);
        BD::altaPregunta($pre);
        $idPregunta = BD::ultimoIdInsertado("autoescuela.pregunta");
        $pre->id = $idPregunta;
        for($j=2; $j<=5;$j++){
            $r = new Respuesta($a[$i][$j], $idPregunta);
            BD::altaRespuesta($r);
            $idRespuesta = BD::ultimoIdInsertado("autoescuela.respuesta");
            $r->id = $idRespuesta;

            if($j==(int)$a[$i][6]+1){
                BD::altaRespuestaCorrecta($pre, $r);
            }
        }
    }
    $obj->respuesta = true;
    
  } else {
    $obj->respuesta = false;
    
}

    

    ?>