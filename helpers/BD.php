<?php
require_once('./entidades/usuario.php');
require_once('./entidades/respuesta.php');
require_once('./entidades/tematica.php');

class BD{
    private static $con;

    public static function conecta(){
        self::$con = new PDO('mysql:host=localhost;dbname=autoescuela', 'root', '');
    }

    public static function obtieneTabla($tabla){
        $res = self::$con->query("Select * from autoescuela.$tabla");
        return $res;
    }


    //Metodos relacionados con el usuario

    public static function obtieneUsuariosJSON(){
        $ret = array();

        $res = self::$con->query("Select * from autoescuela.usuario");

        $filas = $res->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($filas);

    }

    public static function obtieneUsuario($email,$password){
        $res = self::$con->query("Select * from Autoescuela.usuario where email = '$email' and password = '$password'");


        if($res != false){
            $registro = $res->fetch();

            $u = new usuario($registro['email'],$registro['nombre'],$registro['apellidos'],$registro['password'],$registro['fecha_nacimiento'],$registro['rol'],$registro['foto'],$registro['activo']);

            $u->id = $registro['id'];

            return $u;
        }

        return false;
    }

    public static function existeUsuario($email, $password){
        $res = self::$con->query("Select * from Autoescuela.usuario where email = '$email' and password = '$password'");

        $cons = $res->fetch();
        if($cons!=0){
            return true;
        }
            return false;
    }

    public static function altaUsuario(usuario $u){

        $res = self::$con->prepare("Insert into autoescuela.usuario values (default, :email, :nombre, :apellidos, :password, :fecha_nacimiento, :rol, :foto, :activo)");

        $nombre = $u->nombre;
        $email = $u->email;
        $password = $u->password;
        $rol = $u->rol;
        $apellidos = $u->apellidos;
        $fecha_nacimiento = $u->fecha_nacimiento;
        $foto = $u->foto;
        $activo = $u->activo;


        $res->bindParam(':email',$email);
        $res->bindParam(':nombre',$nombre);
        $res->bindParam(':apellidos',$apellidos);
        $res->bindParam(':password',$password);
        $res->bindParam(':fecha_nacimiento',$fecha_nacimiento);
        $res->bindParam(':rol',$rol);
        $res->bindParam(':foto',$foto);
        $res->bindParam(':activo',$activo);

        $res->execute();
    }

    public static function altaUsuarioTemporal($id, $md5, $fecha){

        $res = self::$con->prepare("Insert into autoescuela.comprobarUsuario values(:idUsuario, :md5, :fecha)");

        $res->bindParam(':idUsuario',$id);
        $res->bindParam(':md5',$md5);
        $res->bindParam(':fecha',$fecha);
        $res->execute();
    }


    public static function obtieneId($id){

        $res = self::$con->query("Select * from Autoescuela.usuario where md5 = '$id'");

        $cons = $res->fetch();
        if($cons!=0){
            return $cons[0];
        }
            return false;
    }


    public static function modificaUsuario($id, $password, $nombre = "", $apellido = ""){
        $res = self::$con->prepare("Update autoescuela.usuario set 'password' = :password, 'nombre' = :nombre, 'apellidos' = :apellidos where 'id' = :id)");

        $res->bindParam(':password',$password);
        $res->bindParam(':nombre',$nombre);
        $res->bindParam(':apellidos',$apellidos);
        $res->bindParam(':id',$id);



        $res->execute();
    }

    // public static function bajaUsuario(usuario $u){
    //     $correo = $u->getCorreo();

    //     $res = self::$con->prepare("Delete from Tienda.users where Correo = '$correo'");
    //     $res->bindParam(':correo',$correo);
    //     $res->execute();
    // }


    //Metodos relacionados con las tematicas

    public static function obtieneTematicasJSON(){

        $res = self::$con->query("Select * from autoescuela.tematica");

        $filas = $res->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($filas);

    }


    public static function obtieneTematica($id){
        $res = self::$con->query("Select * from autoescuela.tematica where id='$id'");

        if($res != false){
            $registro = $res->fetch();

            $u = new tematica($registro['descripcion']);

            $u->id = $registro['id'];

            return $u;
        }
    }


    //Metodos relacionados con las preguntas y respuestas

    public static function altaPregunta(pregunta $u){

        $res = self::$con->prepare("Insert into autoescuela.pregunta (id, enunciado, imagen, tematica) values(default, :enunciado, :imagen, :tematica)");

        //Inserto una pregunta, todavia sin el array de preguntas
        $enunciado = $u->enunciado;
        $imagen = $u->imagen;
        $tematica = $u->tematica->id;


        $res->bindParam(':enunciado',$enunciado);
        $res->bindParam(':imagen',$imagen);
        $res->bindParam(':tematica',$tematica);

        $res->execute();


    }


    public static function addRespuestas($r, $id){
        $res = self::$con->prepare("Update autoescuela.pregunta set 'respuestas' = :respuestas where 'id' = :id)");

        $res->bindParam(':respuestas',$r);
        $res->bindParam(':id',$id);

        $res->execute();

    }


    //Metodo que inserta una respuesta


    public static function altaRespuesta(respuesta $r){
        $res = self::$con->prepare("Insert into autoescuela.respuesta values(default, :enunciado, :id_pregunta)");

        //Inserto una pregunta, todavia sin el array de preguntas
        $enunciado = $r->enunciado;
        $id_pregunta = $r->id_pregunta;

        $res->bindParam(':enunciado',$enunciado);
        $res->bindParam(':id_pregunta',$id_pregunta);

        $res->execute();

    }

    //json que devuelve las preguntas

    public static function obtienePreguntasJSON(){
        $ret = array();

        $res = self::$con->query("Select * from autoescuela.pregunta");

        $filas = $res->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($filas);

    }


    //json que devuelve las respuestas

    public static function obtieneRespuestasJSON($idPregunta){
        $ret = array();

        $res = self::$con->query("Select * from autoescuela.respuesta where id_pregunta='$idPregunta'");

        $filas = $res->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($filas);

    }

    //Metodo que inserta en la tabla pregunta-respuesta

    public static function altaRespuestaCorrecta(pregunta $p,respuesta $r){
        $res = self::$con->prepare("Insert into autoescuela.pregunta_respuesta values(:id_pregunta, :id_respuesta)");

        //Inserto una pregunta, todavia sin el array de preguntas
        $id_respuesta = $r->id;
        $id_pregunta = $p->id;

        $res->bindParam(':id_pregunta',$id_pregunta);
        $res->bindParam(':id_respuesta',$id_respuesta);

        $res->execute();

    }

    public static function ultimoIdInsertado($tabla){
        $res = self::$con->query("select id from $tabla order by id desc limit 0,1");

        if($res != false){
            $registro = $res->fetchColumn();
            return (int)$registro;
        }
    }
}