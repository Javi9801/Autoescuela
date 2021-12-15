<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/cargaPreguntasExamen.js"></script>
    <script src="js/funcionesAdicionales.js"></script>
    <script src="js/enviarExamen.js"></script>
    <script src="js/validar.js"></script>
</head>
<body>
    <?php include ("includes/nav.php");?>

    <section class="contenido">

        <form action="" class="form_examen" id="form_examen" method="POST">
        <h1>Examen/Alta Examen</h1>

            <p>
                <label for="examen_descripcion">Descripcion</label>
                <input type="text" id="examen_descripcion" class="campos" name="examen_descripcion" value="">
                <label for="examen_duracion">  Duracion</label>
                <input type="number" id="examen_duracion" class="campos" name="examen_duracion" value="">

                <input type="submit" id="examen_enviar" name="examen_enviar" class="btn_form" value="Enviar Examen">
            </p>

            <p>Filtro
            <input type="text" id="texto" name="texto" value="">
            </p>

            <section id="contenedor_preguntas" class="contenedorP">
            <h1>Preguntas</h1>
            </section>


                <img class="central" src="recursos/flechas.jpg" width="100px" alt="">

            <section id="contenedor_preguntas_examen" name="contenedor_preguntas_examen" class="contenedorP">

            <h1>Contenedor</h1>
            </section>

        </form>



    </section>

    <?php include ("includes/footer.php");?>

</body>
</html>

<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");

$obj = new stdClass();
if(isset($_POST['examen_enviar'])){
    BD::conecta();
    $descripcion = $_POST["examen_descripcion"];
    $duracion = $_POST["examen_descripcion"];

}
?>