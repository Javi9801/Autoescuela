<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Alta Usuario</h1>
    <form action="altaUsuario.php" method="POST">

        <label for="usuario_email">Email</label>
        <p><input type="email" id="usuario_email" name="usuario_email" value=""></p>

        <label for="usuario_nombre">Nombre</label>
        <p><input type="text" id="usuario_nombre" name="usuario_nombre" value=""></p>

        <label for="usuario_apellidos">Apellidos</label>
        <p><input type="text" id="usuario_apellidos" name="usuario_apellidos" value=""></p>

        <!-- <label for="usuario_contraseña">Contraseña</label>
        <p><input type="password" id="usuario_contraseña" name="usuario_contraseña" value=""></p> -->

        <label for="usuario_contraseña1">Confirmar Contraseña</label>
        <p><input type="password" id="usuario_contraseña1" name="usuario_contraseña1" value=""></p>

        <label for="usuario_fecha">Fecha Nacimiento</label>
        <p><input type="date" id="usuario_fecha" name="usuario_fecha" value=""></p>

        <label for="usuario_imagen">Foto Usuario</label>
        <p><input type="file" id="usuario_imagen" name="usuario_imagen" value=""></p>

        <p><input type="submit" id="usuario_enviar" name="usuario_enviar" value="Aceptar"></p>

    </form>
</body>
</html>

<?php
require_once("entidades/usuario.php");
require_once("helpers/BD.php");
require_once("helpers/sesion.php");

sesion::iniciar();
$u = sesion::leer('usuario');

if($u->rol=1){


    if(isset($_POST["usuario_enviar"])){
        BD::conecta();
        $nombre = $_POST['usuario_nombre'];
        $email = $_POST['usuario_email'];
        $password = $_POST['usuario_contraseña'];
        // $rol = $_POST['rol'];
        $apellidos = $_POST['usuario_apellidos'];
        $fecha_nacimiento = $_POST['usuario_fecha'];
        // $foto = $_POST['foto'];
        // $activo = $_POST['activo'];


        $u = new Usuario($email,$nombre,$apellidos,$password,$fecha_nacimiento,1,"jorge.png",1);
    }

} else {
    header("location: loginUsuario.php");
}

?>