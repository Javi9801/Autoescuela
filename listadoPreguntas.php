<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
?>

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


        <h1>Listado Preguntas</h1>


        <?php
        BD::conecta();
        $cabeceras = array("Id","Enunciado", "Tematica");
        echo Funciones::pintaTabla("Autoescuela.pregunta", $cabeceras)?>;

</body>
</html>