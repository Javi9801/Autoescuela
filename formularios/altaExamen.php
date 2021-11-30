<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/main.css">
    <script src="js/cargaPreguntasExamen.js"></script>
</head>
<body>
    <?php include ("../includes/nav.php");?>

    <section class="contenido">

        <form action="altaExamen.php" class="form_examen" method="POST">
        <h1>Examen/Alta Examen</h1>

            <p>
                <label for="descripcion_examen">Descripcion</label>
                <input type="text" id="descripcion_examen" name="descripcion_examen" value="">
                <label for="descripcion_examen">  Duracion</label>
                <input type="number" id="duracion_examen" name="duracion_examen" value="">

                <input type="submit" id="enviar_examen" namae="enviar_examen" class="btn_examen" value="Enviar Examen">
            </p>

            <p><input type="submit" id="cargar_preguntas" name="cargar_preguntas" value="Cargar"></p>

            <section id="contenedor_preguntas" class="contenedorP">
            <h1>Preguntas</h1>
            </section>


                <img class="central" src="recursos/flechas.jpg" width="100px" alt="">

            <section id="contenedor_preguntas_examen" class="contenedorP">

            <h1>Contenedor</h1>
            </section>

        </form>



    </section>

    <?php include ("includes/footer.php");?>

</body>
</html>

<?php
require_once("../cargadores/cargarHelper.php");
require_once("../cargadores/cargarEntidades.php");
require_once("../cargadores/cargarIncludes.php");


if(isset($_POST["examen_enviar"])){
    BD::conecta();


}
?>