<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/funcionesAdicionales.js"></script>
    <script src="js/cargaImagenes.js"></script>
    <script src="js/validar.js"></script>
</head>
<body>
    <?php include ("includes/nav.php");?>

    <section class="contenido">


        <form action="altaPregunta.php" method="POST" enctype="multipart/form-data">

        <h1>Alta Preguntas</h1>
            <label for="pregunta_tematica">Tematica</label>
            <p>
                <?php
                    require_once("helpers/funciones.php");
                    echo(funciones::selectDinamico("pregunta_tematica", "tematica"));
                ?>
            </p>

            <label for="pregunta_enunciado">Enunciado</label>
            <p><textarea name="pregunta_enunciado" class="campos" id="pregunta_enunciado" cols="30" rows="10"></textarea></p>

            <p>
                <label for="pregunta_imagen">Imagen </label>
                <input type="file" id="pregunta_imagen" name="pregunta_imagen">
                <input type="button" value="Cargar" id="imagen_cargar">
            </p>


            <p>
                <label for="pregunta_respuesta_1">Opcion 1 </label>
                <input type="text" id="pregunta_respuesta_1" class="campos" name="pregunta_respuesta_1" value="">
                <input type="radio" id="opcion1" value="opcion1" name="opciones"> Correcta
            </p>


            <p>
                <label for="pregunta_respuesta_2">Opcion 2 </label>
                <input type="text" id="pregunta_respuesta_2" class="campos" name="pregunta_respuesta_2" value="">
                <input type="radio" id="opcion2" value="opcion2" name="opciones"> Correcta

            </p>

            <p>
                <label for="pregunta_respuesta_3">Opcion 3 </label>
                <input type="text" id="pregunta_respuesta_3" class="campos" name="pregunta_respuesta_3" value="">
                <input type="radio" id="opcion3" value="opcion3" name="opciones"> Correcta

            </p>


            <p>
                <label for="pregunta_respuesta_4">Opcion 4</label>
                <input type="text" id="pregunta_respuesta_4" class="campos" name="pregunta_respuesta_4" value="">
                <input type="radio" id="opcion4" value="opcion4" name="opciones"> Correcta
            </p>



            <p><input type="submit" id="pregunta_enviar" name="pregunta_enviar" class="btn_form" value="Aceptar"></p>

        </form>

    </section>

    <?php include ("includes/footer.php");?>
</body>
</html>

<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");





    if(isset($_POST["pregunta_enviar"]) && isset($_POST["opciones"])){
        BD::conecta();
        $enunciado = $_POST['pregunta_enunciado'];
        $tematica = BD::obtieneTematica($_POST['pregunta_tematica']);

        $validar = new Validacion();
        $validar->Requerido($enunciado);
        $validar->Requerido($tematica);


        // move_uploaded_file($_FILES['pregunta_imagen']['tmp_name'],"./recursos.imagen1.jpg");
        $foto = file_get_contents($_FILES['pregunta_imagen']['tmp_name']);
        $foto = base64_encode($foto);

        for($i=1; $i<=4;$i++){
            $validar->Requerido($_POST['pregunta_respuesta_'.$i.'']);
        }
        $validar->Requerido($_POST['opciones']);
        $respuestas = array();

        if($validar->ValidacionPasada()){

            $p = new Pregunta($enunciado,$foto,$tematica);
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
    }
?>
