<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="altaPregunta.php" method="POST">

        <label for="pregunta_tematica">Tematica</label>
        <p>
            <?php
                require_once("helpers/funciones.php");
                funciones::selectDinamico("pregunta_tematica", "tematica");
            ?>
        </p>

        <label for="pregunta_enunciado">Enunciado</label>
        <p><textarea name="pregunta_enunciado" id="pregunta_enunciado" cols="30" rows="10"></textarea></p>

        <label for="pregunta_respuesta_1">Opcion 1</label>
        <p><input type="text" id="pregunta_respuesta_1" name="pregunta_respuesta_1" value="">
        <input type="radio" id="opcion1" name="opciones"> Correcta
        </p>

        <label for="pregunta_respuesta_2">Opcion 2</label>
        <p><input type="text" id="pregunta_respuesta_2" name="pregunta_respuesta_2" value="">
        <input type="radio" id="opcion2" name="opciones"> Correcta

        </p>

        <label for="pregunta_respuesta_3">Opcion 3</label>
        <p><input type="text" id="pregunta_respuesta_3" name="pregunta_respuesta_3" value="">
        <input type="radio" id="opcion3" name="opciones"> Correcta

        </p>

        <label for="pregunta_respuesta_4">Opcion 4</label>
        <p><input type="text" id="pregunta_respuesta_4" name="pregunta_respuesta_4" value="">
        <input type="radio" id="opcion4" name="opciones"> Correcta
        </p>



        <p><input type="submit" id="pregunta_enviar" name="pregunta_enviar" value="Aceptar"></p>

    </form>
</body>
</html>

<?php
require_once("entidades/pregunta.php");
require_once("helpers/BD.php");



    if(isset($_POST["pregunta_enviar"])){
        BD::conecta();
        $enunciado = $_POST['pregunta_enunciado'];
        $tematica = BD::obtieneTematica($_POST['pregunta_tematica']);
        $password = $_POST['usuario_contraseña'];
        // $rol = $_POST['rol'];
        $apellidos = $_POST['usuario_apellidos'];
        $fecha_nacimiento = $_POST['usuario_fecha'];
        // $foto = $_POST['foto'];
        // $activo = $_POST['activo'];


        $u = new Usuario($email,$nombre,$apellidos,$password,$fecha_nacimiento,1,"jorge.png",1);
    }

?>