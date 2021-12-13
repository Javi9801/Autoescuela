<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/funcionesAdicionales.js"></script>
    <script src="js/recogerExamen.js"></script>
    <!-- <script src="js/corregirExamenes.js"></script> -->

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
                <label id="idFinalH" hidden for=""><?php echo ($_GET['idExamen'])?></label>
                <section id="preguntas_examenH">


                <?php


        }
            ?>
                </section>
            </form>
            <section class="botones_examen">
                <input type="button" id="anteriorH" class="anterior" value="Anterior">
                <input type="button" id="siguienteH" class="siguiente" value="Siguiente">
            </section>

            <section id="paginador_examenH"></section>
    </section>

    <?php include ("includes/footer.php");?>
</body>
</html>


