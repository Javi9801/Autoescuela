<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/cargaPreguntasExamen.js"></script>
</head>
<body>
    <?php include ("includes/nav.php");?>

    <section class="contenido">

        <form action="listadoPreguntas.php" class="form_listado_preguntas" method="POST">
        <h1>Listado Preguntas</h1>

            <p>
                <label for="descripcion_examen">Descripcion</label>
                <input type="text" id="descripcion_examen" name="descripcion_examen" value="">
                <label for="descripcion_examen">  Duracion</label>
                <input type="text" id="duracion_examen" name="duracion_examen" value="">

            </p>

            <p><input type="submit" id="cargar_preguntas" name="cargar_preguntas" value="Cargar"></p>

        </form>


        <section id="contenedor_preguntas" class="contenedorP">
        <h1>Preguntas</h1>
        </section>

        <section id="contenedor_preguntas_examen" class="contenedorP">

        <h1>Contenedor</h1>
        </section>
    </section>


</body>
</html>

<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");