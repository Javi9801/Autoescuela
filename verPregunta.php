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


        <form action="" method="POST">

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
                    echo(funciones::selectDinamico("pregunta_tematica", "tematica", $tematica->id));
                ?>
            </p>

            <label>Enunciado</label>
            <p><textarea name="pregunta_enunciado" id="pregunta_enunciado" cols="30" rows="10"><?php echo $p->enunciado?></textarea></p>


            <?php

            $respuestas = [];
            $respuestas = BD::obtieneRespuestas($id);
            $nRespuestas = count($respuestas);
            $html="";

            for($i=0; $i<$nRespuestas;$i++){
                $opc = $i+1;
                $html .= '<p>';
                $html .='<label>Opcion '.$opc.'</label>  ';
                $html .='<input type="text" value="'.$respuestas[$i]->enunciado.'">';
                $html .='<input type="radio" id="opcion_'.$opc.'" value="opcion1" name="opciones"> Correcta';
                $html .='</p>';
            }

            echo $html;
            ?>



        </form>

    </section>

    <?php include ("includes/footer.php");?>
</body>
</html>
