<?php
require_once("entidades/usuario.php");
require_once("helpers/BD.php");
require_once("helpers/sesion.php");
require_once("helpers/correo.php");

BD::conecta();

if(isset($_GET['id'])){
    $idUsuario = BD::obtieneID($_GET['id']);
    if($idUsuario!=false){
        $u = BD::obtieneUsuario($idUsuario);
?>
        <form action="" method="POST">
            <label for="usuario_email">Email</label>
            <p><input type="email" disabled id="usuario_email_1" name="usuario_email_1" value="<?php $u->email?>"></p>

            <label for="usuario_nombre">Nombre</label>
            <p><input type="text" id="usuario_nombre_1" name="usuario_nombre_1" value="<?php $u->nombre?>"></p>

            <label for="usuario_apellidos">Apellidos</label>
            <p><input type="text" id="usuario_apellidos_1" name="usuario_apellidos_1" value="<?php $u->apellidos?>"></p>

            <label for="usuario_contraseña_1">Contraseña</label>
            <p><input type="text" id="usuario_contraseña_1" name="usuario_contraseña_1" value=""></p>

            <p><input type="submit" id="usuario_enviar_1" name="usuario_enviar_1" value="Guardar"></p>
    </form>

<?php

if(isset($_POST["usuario_enviar_1"])){
    if(isset($_POST["usuario_nombre_1"]) && isset($_POST["usuario_apellidos_1"])){
        BD::modificaUSuario($idUsuario, $_POST['usuario_contraseña_1'], $_POST["usuario_nombre_1"], $_POST["usuario_apellidos_1"]);
    } else {
        BD::modificaUSuario($idUsuario, $_POST['usuario_contraseña_1']);
    }

    $u = BD::obtieneUsuario($idUsuario);
    sesion::iniciar();
    sesion::escribir('usuario', $u);
    header("Location: paginaInicio.php");
}


    } else {
        header("location: loginUsuario.php");
    }
}
?>

