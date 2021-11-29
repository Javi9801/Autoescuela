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


        <h1 class="h1_preguntas">Listado Preguntas</h1>


        <?php

        if(isset($_GET['pag'])){
            $pag = $_GET['pag'];
            $total = 5*$pag;
        } else {
            $pag = 0;
            $total = 0;
        }




        BD::conecta();
        $cabeceras = array("Id","Enunciado", "Tematica");

        echo Funciones::pintaTabla("Autoescuela.pregunta", $cabeceras, $total, 5);

        $registros = BD::obtienefilas("Autoescuela.pregunta");
        $enlace = '<p>';
        $aux = round($registros/5);
        for($i=0; $i<$aux;$i++){
            $enlace.="<a href='listadoPreguntas.php?pag=$i'>$i</a>";
        }


        $enlace.= '</p>';
        ?>

        <div><?php echo $enlace ?></div>

    </section>

</body>
</html>