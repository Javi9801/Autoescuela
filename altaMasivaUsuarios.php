<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/altaMasivaUsuario.js"></script>
</head>
<body>
    <?php include ("includes/nav.php");?>




    <section class="contenido">
        <!-- <input id="fileInput" type="file" size="50" onchange="processFiles(this.files)"> -->
       <section class="altasMasivas">
        <textarea id="fileOutput" rows="20" cols="80"></textarea><br>
        <button id="enviar_archivo_usuarios" value="Enviar">Enviar</button>
       </section>
    </section>
</body>
</html>


<?php

include_once("cargadores/cargarHelper.php");
include_once("cargadores/cargarEntidades.php");
$obj = new stdClass();
BD::conecta();

sesion::iniciar();
$u = sesion::leer('usuario');


if(isset($_POST["usuarios"])){

    $p = $_POST["usuarios"];
   

    $a = json_decode($p, true);

    $examen = BD::obtieneExamen($id);

$e = $a[0][0];

    BD::altaExamenHecho($examen, $u, "Now()", 3, $p);


    $obj->respuesta = true;
    
  } else {
    $obj->respuesta = false;
    
}

    

    ?>