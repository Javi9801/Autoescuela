<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">

</head>


<body>

    <section class="imagen_form">
        <p><img src="recursos/logo.png"  width="150px" height="150px" alt=""></p>
    </section>
    <form id="login_form" class="login" action="" method="POST">

        <label for="login_usuario">Usuario/Email</label>
        <p><input type="text" class="inputs" id="login_email" name="login_email" value="" placeholder="Escriba aqui"> <span class="error_login">Usuario Incorrecto</span></p>



        <label for="login_contraseña">Contraseña</label>
        <p><input type="password" class="inputs" id="login_contraseña" name="login_contraseña" value="" placeholder="Escriba aqui"> <span class="error_login">Contraseña Incorrecto</span></p>



        <!-- <p>
            <input type="checkbox" name="recuerdame" id="recuerdame">Recuerdame
        </p> -->

        <!-- <p><a href="#">¿Has olvidado tu contraseña?</a></p> -->


        <p><input class="btn_enviar" type="submit" name="aceptar" id="aceptar" value="ACEPTAR"></p>
    </form>


    <!-- <p><a href="altaUsuario.php">Nueva cuenta de usuario</a></p> -->
</body>
</html>

<?php
    require_once("cargadores/cargarHelper.php");
    require_once("cargadores/cargarEntidades.php");
    require_once("cargadores/cargarIncludes.php");

    $error = "";


    if(isset($_POST['aceptar'])){
        $usuario = $_POST['login_email'];
        $password = $_POST['login_contraseña'];

        $validar = new Validacion();
        $validar->Requerido($usuario);
        $validar->Requerido($password);
            if($validar->ValidacionPasada()){
                sesion::iniciar();
                BD::conecta();
                if(login::identifica($usuario, $password, false)){
                    if(login::usuarioEstaLogueado()){
                        sesion::escribir('usuario', BD::obtieneUsuario($usuario, $password));
                        $u = BD::obtieneUsuario($usuario, $password);
                        if($u->activo==0){
                            header("Location: comprobarContrasena.php?id=$u->password");
                        } else {
                            header("Location: ./index.php");
                        }
                    }
                } else {
                    header("Location: loginUsuario.php");
                }
            } else {
                header("Location: loginUsuario.php");
            }

    }


?>