<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");


BD::conecta();
var_dump($_GET['id']);
if(isset($_GET['id'])){
    $p = BD::obtieneID($_GET['id']);
    if($p!=false){
?>
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

<?php

if(isset($_POST["usuario_enviar_1"])){
    if((isset($_POST["usuario_nombre_1"])) && (isset($_POST["usuario_apellidos_1"]))){
        BD::modificaUsuario((int)$p->id, $_POST['usuario_contrasena_1'], $_POST["usuario_nombre_1"], $_POST["usuario_apellidos_1"]);
        //completar esto, no hace el update
    }

    sesion::iniciar();
    sesion::escribir('usuario', $p);
    BD::borraUsuarioTemporal($_GET['id']);
    header("Location: paginaInicio.php");
}


    } else {
        header("location: loginUsuario.php");
    }
}
?>

