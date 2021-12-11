<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");


BD::conecta();
if(isset($_GET['id'])){
    $p = BD::obtieneID($_GET['id']);
    if($p!=false){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/funcionesAdicionales.js"></script>
    <script src="js/cargaImagenes.js"></script>
</head>
<body>
    <?php include ("includes/nav.php");?>

    <section class="contenido">
        <form action="" method="POST">
            <label for="usuario_email">Email</label>
            <p><input type="email" disabled id="usuario_email_1" name="usuario_email_1" value="<?php echo $p->email?>"></p>

            <label for="usuario_nombre">Nombre</label>
            <p><input type="text" id="usuario_nombre_1" name="usuario_nombre_1" value="<?php echo $p->nombre?>"></p>

            <label for="usuario_apellidos">Apellidos</label>
            <p><input type="text" id="usuario_apellidos_1" name="usuario_apellidos_1" value="<?php echo $p->apellidos?>"></p>

            <label for="usuario_contrasena_1">Contraseña</label>
            <p><input type="text" id="usuario_contrasena_1" name="usuario_contrasena_1" value=""></p>

            <p><input type="submit" id="usuario_enviar_1" name="usuario_enviar_1" value="Guardar"></p>
    </form>
    </section>
    <?php include ("includes/footer.php");?>
</body>
</html>
<?php

if(isset($_POST["usuario_enviar_1"])){
    if((isset($_POST["usuario_nombre_1"])) && (isset($_POST["usuario_apellidos_1"]))){
        BD::modificaUsuario($p->id, $_POST['usuario_contrasena_1'], $_POST["usuario_nombre_1"], $_POST["usuario_apellidos_1"]);
        //completar esto, no hace el update
    }
    header("Location: index.php");
}


    } else {
        header("location: loginUsuario.php");
    }
}
?>

