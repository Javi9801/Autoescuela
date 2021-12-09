<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/funcionesAdicionales.js"></script>
    <script src="js/recogerExamen.js"></script>

</head>
<body>
    <?php

    require_once("cargadores/cargarHelper.php");
    require_once("cargadores/cargarEntidades.php");
    include ("includes/nav.php");
    BD::conecta();
    $examen = BD::obtieneExamen($_GET['idExamen']);

    ?>

    <section class="contenido">

        <?php

        sesion::iniciar();
        $u = sesion::leer('usuario');
        $rol = BD::obtieneRol($u->rol);

        if($rol->id==1){
        ?>
            <form action="" method="POST">
                <h1 class="h1_preguntas"><?php echo $examen->descripcion?></h1>
                <label id="idFinal" hidden for=""><?php echo ($_GET['idExamen'])?></label>
                <section id="preguntas_examen">


                <?php


        }
            ?>
                </section>
                <input type="submit" class="btn_enviar" id="finalizar_examen" name="finalizar_examen" value="Finalizar">
            </form>
            <section class="botones_examen">
                <input type="button" id="anterior" class="anterior" value="Anterior">
                <input type="button" id="siguiente" class="siguiente" value="Siguiente">
            </section>

    </section>

    <?php include ("includes/footer.php");?>
</body>
</html>


<?php

    if(isset($_POST["finalizar_examen"])){

        $preguntas_respuestas = [];
        for($i=0; $i<$n_preg; $i++){
            for($j=0; $j<$n_resp; $j++){
                if($_POST['opciones'.$i.''] == 'opcion'.$j.''){
                    $a = $p[$i]->id;
                    $b = $resp[$i][$j]->id;
                    $preguntas_respuestas[$a] = $b;
                }
            }
        }

        BD::altaExamenHecho($examen, $u, "Now()", 3, json_encode($preguntas_respuestas));

    }

?>