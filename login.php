<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <form id="login_form" action="" method="POST">
        <label for="login_usuario">Usuario/Email</label>
        <p><input type="text" id="login_email" name="login_email" value=""> <span class="error_login">Usuario Incorrecto</span></p>

        

        <label for="login_contraseña">Contraseña</label>
        <p><input type="text" id="login_contraseña" name="login_contraseña" value=""> <span class="error_login">Contraseña Incorrecto</span></p>

        <p><input type="submit" name="aceptar" id="aceptar" value="Aceptar"></p>
    </form>

    <p><a href="#">¿Has olvidado tu contraseña?</a></p>
    <p><a href="altaUsuario.php">Nueva cuenta de usuario</a></p>
</body>
</html>

