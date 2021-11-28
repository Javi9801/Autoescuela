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

    <?php include ("includes/nav.php");?>

    <section class="contenido">


        <form action="altaUsuario.php" method="POST">

        <h1>Alta Usuario</h1>

            <label for="usuario_email">Email</label>
            <p><input type="email" id="usuario_email" name="usuario_email" value=""></p>

            <label for="usuario_nombre">Nombre</label>
            <p><input type="text" id="usuario_nombre" name="usuario_nombre" value=""></p>

            <label for="usuario_apellidos">Apellidos</label>
            <p><input type="text" id="usuario_apellidos" name="usuario_apellidos" value=""></p>

            <label for="usuario_fecha">Fecha Nacimiento</label>
            <p><input type="date" id="usuario_fecha" name="usuario_fecha" value=""></p>

            <label for="usuario_imagen">Foto Usuario</label>
            <p><input type="file" id="usuario_imagen" name="usuario_imagen" value=""></p>

            <label for="usuario_rol">Rol</label>
            <?php
                    require_once("helpers/funciones.php");
                    echo(funciones::selectDinamico("usuario_rol", "rol"));
                ?>
            <p><input type="submit" id="usuario_enviar" name="usuario_enviar" value="Aceptar"></p>

        </form>
</section>
<?php include ("includes/footer.php");?>
</body>
</html>

<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");

sesion::iniciar();
$u = sesion::leer('usuario');

if($u->rol=="2"){


    if(isset($_POST["usuario_enviar"])){
        BD::conecta();
        $nombre = $_POST['usuario_nombre'];
        $email = $_POST['usuario_email'];

        $idRecuperar = md5(rand(1,5000000).date(DATE_RFC2822));
        // $password = d;
        // $rol = $_POST['rol'];
        $apellidos = $_POST['usuario_apellidos'];
        $fecha_nacimiento = $_POST['usuario_fecha'];
        // $foto = $_POST['foto'];
        // $activo = $_POST['activo'];


        $p = new Usuario($email,$nombre,$apellidos,$idRecuperar,$fecha_nacimiento,1,"jorge.png",1);
        BD::altaUsuario($p);

        $p->id = BD::ultimoIdInsertado("autoescuela.usuario");

        BD::altaUsuarioTemporal((int)$p->id, $idRecuperar, date(DATE_RFC2822));

        $html = '
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Recuperar</title>
        </head>
        <body>

        <h2>Enlace para loguearse</h2>
        <a href="localhost/autoescuela/comprobarContrasena.php?id='.$idRecuperar.'">Pulse aqui para recuperar la contraseña</a>
        </body>
        </html>';

        correo::enviar("javijd23@gmail.com", "dmbaloncesto10", "Recupera tu password", "Recuperar", $html, $p->email, "recursos/perfil.png");
        //Falta comprobar si ha caducado


    }

} else {
    header("location: loginUsuario.php");
}

?>