<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/funcionesAdicionales.js"></script>
</head>
<body>

    <?php include ("includes/nav.php");?>



    <section class="contenido">


        <form class="form_usuario" action="" method="POST" enctype="multipart/form-data">

        <?php
            require_once("cargadores/cargarHelper.php");
            require_once("cargadores/cargarEntidades.php");
            require_once("cargadores/cargarIncludes.php");

            BD::conecta();
            $id = $_GET["idUsuario"];

            $p = BD::obtieneUsuarioExamen($id);
            $rol = BD::obtieneRol($p->rol);
        ?>

        <h1>Usuario <?php echo $id?></h1>

            <label for="ver_usuario_email">Email</label>
            <p><input type="email" id="ver_usuario_email" name="ver_usuario_email" disabled value="<?php echo $p->email?>"></p>

            <label for="ver_usuario_nombre">Nombre</label>
            <p><input type="text" id="usuario_nombre" name="ver_usuario_nombre" value="<?php echo $p->nombre?>"></p>

            <label for="ver_usuario_apellidos">Apellidos</label>
            <p><input type="text" id="ver_usuario_apellidos" name="ver_usuario_apellidos" value="<?php echo $p->apellidos?>"></p>

            <label for="ver_usuario_fecha">Fecha Nacimiento</label>
            <p><input type="date" id="ver_usuario_fecha" name="ver_usuario_fecha" value="<?php echo $p->fecha_nacimiento?>"></p>

            <label for="ver_usuario_imagen">Foto Usuario</label>
            <p><input type="file" id="ver_usuario_imagen" name="ver_usuario_imagen" value="<?php echo $p->foto?>"></p>
            <div>
                <img src="data:image/jpg;base64,<?php echo $p->foto?>" width="100px" alt="">
            </div>

          
            <p><input type="submit" id="ver_usuario_enviar" name="ver_usuario_enviar" class="btn_form" value="Aceptar"></p>

        </form>
</section>
<?php include ("includes/footer.php");?>
</body>
</html>

<?php

sesion::iniciar();
$u = sesion::leer('usuario');

if(isset($_POST["ver_usuario_enviar"])){
    BD::conecta();
    $nombre = $_POST['ver_usuario_nombre'];
    $apellidos = $_POST['ver_usuario_apellidos'];
    $fecha = $_POST['ver_usuario_fecha'];
    


    $validar = new Validacion();
    $validar->Requerido($nombre);
    $validar->Requerido($apellidos);
    $validar->Requerido($fecha);


    // move_uploaded_file($_FILES['pregunta_imagen']['tmp_name'],"./recursos.imagen1.jpg");
    $foto = file_get_contents($_FILES['ver_usuario_imagen']['tmp_name']);
    $foto = base64_encode($foto);

    if($validar->ValidacionPasada()){
        BD::modificaUsuarioCompleto($id, $nombre, $apellidos, $fecha, $foto);
    }
}
?>
