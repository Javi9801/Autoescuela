<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/funcionesAdicionales.js"></script>
    <script src="js/corregirExamenes.js"></script>
    <!-- <script src="js/corregirExamenes.js"></script> -->

</head>
<body>
    <?php

    require_once("cargadores/cargarHelper.php");
    require_once("cargadores/cargarEntidades.php");
    include ("includes/nav.php");
    BD::conecta();
    $examen = BD::obtieneExamen($_GET["idExamen"]);

    $idL = $_GET["id"];

    $preguntasCorrectas = [];
    $preguntasCorrectas = JSON_decode(BD::obtieneIdExamenHecho($_GET["idExamen"], $idL));

    ?>

    <section class="contenido">

        <?php

        sesion::iniciar();
        $u = sesion::leer('usuario');
        $rol = BD::obtieneRol($u->rol);
        $input="";
        $html ="";
        if($rol->id==1){
        ?>
            <form action="" method="POST">
                <h1 class="h1_preguntas"><?php echo $examen->descripcion?></h1>
                <label id="idFinalH" hidden for=""><?php echo ($_GET['idExamen'])?></label>
                <section id="preguntas_examenH">


                <?php


        }
            ?>
                </section>

                <section id="preguntasCorrectas" hidden>

                    <?php

                        for($i=0; $i<count($preguntasCorrectas);$i++){
                            $pre = $preguntasCorrectas[$i]->pregunta;
                            $re = $preguntasCorrectas[$i]->respuesta->id;
                            $co = BD::obtieneRespuestaCorrecta($pre);
                            $input.="<input resp='$co' type='text' id='preg_$pre' value='$re'>";
                        }

                        echo $input;
                    ?>


                </section>
            </form>
            <section class="botones_examen">
                <input type="button" id="anteriorH" class="anterior" value="Anterior">
                <input type="button" id="siguienteH" class="siguiente" value="Siguiente">
            </section>

            <section id="paginador_examenH"></section>

            <section id="muestraRespuestas">
<?php
            foreach($preguntasCorrectas as $i){
            $c = BD::obtieneRespuestaCorrecta($i->pregunta);
                if($i->respuesta->id == $c){
                    $html.='<p><em class="cor">Correcta</em> A la pregunta <strong>'.BD::obtienePregunta($i->pregunta)->enunciado.' </strong>has respondido <strong>'.$i->respuesta->enunciado.' </strong>y es la respuesta correcta</p>';
                } else {
                    $html.='<p><em class="inc">Incorrecta</em> A la pregunta <strong> '.BD::obtienePregunta($i->pregunta)->enunciado.' </strong>has respondido <strong>'.$i->respuesta->enunciado.'</strong> y la respuesta correcta es <strong>'.BD::obtieneRespuesta($c)->enunciado.'</strong></p>';
                }
            }

            echo $html;

?>

        </section>
    </section>

    <?php include ("includes/footer.php");?>
</body>
</html>

