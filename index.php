<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");

sesion::iniciar();
if(!sesion::existe("login")){
    header("Location: loginUsuario.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/funcionesAdicionales.js"></script>
    <title>Document</title>
</head>
<body>
    <?php include ("includes/nav.php");?>
   <section id="imagen_index"> <img src="recursos/zonaL.JPG" alt=""></section>
    <?php include ("includes/footer.php");?>
</body>
</html>