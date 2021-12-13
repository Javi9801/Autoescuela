
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/cargarPreguntasExamen.js"></script>
    <script src="js/funcionesAdicionales.js"></script>
</head>
<body>
    <?php include ("includes/nav.php");?>

    <section class="contenido">


        <form action="" method="POST" enctype="multipart/form-data">

        <?php
            require_once("cargadores/cargarHelper.php");
            require_once("cargadores/cargarEntidades.php");
            require_once("cargadores/cargarIncludes.php");

            BD::conecta();
            $id = $_GET["idPregunta"];

            $p = BD::obtienePregunta($id);
            $tematica = BD::obtieneTematica($p->id);
        ?>


        <h1>Pregunta <?php echo $p->id?></h1>
            <label for="pregunta_tematica">Tematica</label>
            <p>
                <?php
                    require_once("helpers/funciones.php");
                    echo(funciones::selectDinamico("ver_pregunta_tematica", "tematica", $tematica->id));
                ?>
            </p>

            <label>Enunciado</label>
            <p><textarea name="ver_pregunta_enunciado" id="ver_pregunta_enunciado" cols="30" rows="10"><?php echo $p->enunciado?></textarea></p>

            <p>
                <label for="pregunta_imagen">Imagen </label>
                <input type="file" id="ver_pregunta_imagen" name="ver_pregunta_imagen">
            </p>

            <div>
                <img src="data:image/jpg;base64,<?php echo $p->imagen?>" width="100px" alt="">
            </div>


            <?php

            $respuestas = [];
            $respuestas = BD::obtieneRespuestas($id);
            $nRespuestas = count($respuestas);
            $html="";
            $idR = BD::obtieneRespuestaCorrecta($id);

            for($i=0; $i<$nRespuestas;$i++){
                $opc = $i+1;
                $html .= '<p>';
                $html .='<label>Opcion '.$opc.'</label>  ';
                $html .='<input type="text" name="ver_pregunta_respuesta_'.$respuestas[$i]->id.'" value="'.$respuestas[$i]->enunciado.'">';

                
                if($idR == $respuestas[$i]->id){
                    $html .='<input type="radio" id="opcion_'.$respuestas[$i]->id.'" value="opcion'.$respuestas[$i]->id.'" name="opciones" checked> Correcta';
                    
                } else {
                    $html .='<input type="radio" id="opcion_'.$respuestas[$i]->id.'" value="opcion'.$respuestas[$i]->id.'" name="opciones"> Correcta';
                }
                $html .='</p>';
            }

            echo $html;
            ?>

            <input type="submit" id="modificar_pregunta" name="modificar_pregunta" class="btn_enviar" value="Grabar">
        </form>

    </section>

    <?php include ("includes/footer.php");?>
</body>
</html>

<?php
if(isset($_POST["modificar_pregunta"])){
        BD::conecta();
        $enunciado = $_POST['ver_pregunta_enunciado'];
        $tematica = BD::obtieneTematica($_POST['ver_pregunta_tematica']);

        $validar = new Validacion();
        $validar->Requerido($enunciado);
        $validar->Requerido($tematica);


        // move_uploaded_file($_FILES['pregunta_imagen']['tmp_name'],"./recursos.imagen1.jpg");
        $foto = file_get_contents($_FILES['ver_pregunta_imagen']['tmp_name']);
        $foto = base64_encode($foto);

        for($i=0; $i<=3;$i++){
            $validar->Requerido($_POST['ver_pregunta_respuesta_'.$respuestas[$i]->id.'']);
        }
        $validar->Requerido($_POST['opciones']);

        if($validar->ValidacionPasada()){

          BD::modificaPregunta($id, $enunciado, $foto, $tematica);
            

            for($i=0;$i<=3;$i++){
                BD::modificaRespuesta($_POST['ver_pregunta_respuesta_'.$respuestas[$i]->id.''], $respuestas[$i]->id);

                if($_POST['opciones'] == 'opcion'.$respuestas[$i]->id.''){
                    BD::modificaRespuestaCorrecta($id, $respuestas[$i]->id);
                   
                }
            }
            // BD::addRespuestas(BD::obtieneRespuestasJSON($ultId),$ultId);
        }       
       
    }
?>