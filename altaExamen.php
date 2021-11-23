<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php include ("includes/nav.php");?>

    <section class="contenido">

    <h1>Alta Preguntas</h1>
        <form action="altaExamen.php" method="POST">

            <label for="pregunta_tematica">Tematica</label>
           


            <p><input type="submit" id="examen_enviar" name="examen_enviar" value="Guardar"></p>

        </form>

    </section>

    
</body>
</html>

<?php
require_once("entidades/pregunta.php");
require_once("helpers/BD.php");
require_once("entidades/respuesta.php");



if(isset($_POST["examen_enviar"])){
    BD::conecta();
    $enunciado = $_POST['pregunta_enunciado'];
    $tematica = BD::obtieneTematica($_POST['pregunta_tematica']);
    $enunciado = $_POST['pregunta_enunciado'];
    $respuestas = array();

    $p = new Pregunta($enunciado,"imagen",$tematica);
    BD::altaPregunta($p);

    $ultId = BD::ultimoIdInsertado("autoescuela.pregunta");
    $p->id = $ultId;

    for($i=1;$i<=4;$i++){
        $resp = new respuesta($_POST['pregunta_respuesta_'.$i.''], $p->id);
        $respuestas[] = $resp;
        BD::altaRespuesta($resp);

        if($_POST['opciones'] == 'opcion'.$i.''){
            $correcta = new respuesta($_POST['pregunta_respuesta_'.$i.''],$p->id);
            $correcta->id = BD::ultimoIdInsertado("autoescuela.respuesta");
        }
    }

    $p->respuestas = $respuestas;


    // BD::addRespuestas(BD::obtieneRespuestasJSON($ultId),$ultId);

    BD::altaRespuestaCorrecta($p,$correcta);
}
?>
