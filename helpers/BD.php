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

    public static function altaUsuarioTemporal($id, $md5){

        $res = self::$con->prepare("Insert into autoescuela.comprobarUsuario values(:idUsuario, :md5, Now())");

        $res->bindParam(':idUsuario',$id);
        $res->bindParam(':md5',$md5);
        $res->execute();
    }


    public static function obtieneId($id){

        $res = self::$con->query("Select * from Autoescuela.usuario where password = '$id'");
        if($res!=false){
            $registro = $res->fetch();
            $u = new usuario($registro['email'],$registro['nombre'],$registro['apellidos'],$registro['password'],$registro['fecha_nacimiento'],$registro['rol'],$registro['foto'],$registro['activo']);
            $u->id = $registro['id'];
            return $u;
        }
            return false;
    }

    public static function borraUsuarioTemporal($md5){
        $res = self::$con->prepare("Delete from Autoescuela.comprobarUsuario where md5 = '$md5'");
        $res->bindParam(':md5',$md5);
        $res->execute();
    }


    public static function modificaUsuario($id, $password, $nombre, $apellido){
        $res = self::$con->prepare("Update Autoescuela.usuario set `password` = :password, `nombre` = :nombre, `apellidos` = :apellidos where `id` = :id");

        $res->bindParam(':password',$password);
        $res->bindParam(':nombre',$nombre);
        $res->bindParam(':apellidos',$apellido);
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

    //metodo para obtener el rol
    
    public static function obtieneRol($id){
        $res = self::$con->query("Select * from Autoescuela.rol where id = $id");


        if($res != false){
            $registro = $res->fetch();

            $u = new rol($registro['descripcion']);

            $u->id = $registro['id'];

            return $u;
        }

        return false;
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

    public static function obtienePregunta($id){
        $res = self::$con->query("Select * from autoescuela.pregunta where id=$id");

        if($res != false){
            $registro = $res->fetch();

            $u = new pregunta($registro['enunciado'], $registro['imagen'],$registro['tematica'] );

            $u->id = $registro['id'];

            return $u;
        }
    }


    public static function addRespuestas($r, $id){
        $res = self::$con->prepare("Update autoescuela.pregunta set 'respuestas' = :respuestas where 'id' = :id)");

        $res->bindParam(':respuestas',$r);
        $res->bindParam(':id',$id);

        $res->execute();

    }

    //obtiene respuestas de una pregunta

    public static function obtieneRespuestas($idPregunta){
        $ret = array();

        $res = self::$con->query("Select * from autoescuela.respuesta where id_pregunta = $idPregunta");

        while($registro = $res->fetch()){
            $p = new respuesta($registro['enunciado'], $registro['id_pregunta']);
            $p->id = $registro['id'];
            $ret[]=$p;
        }
        return $ret;

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

        $res = self::$con->query("Select id,enunciado,imagen,tematica from autoescuela.pregunta");

        while($registro = $res->fetch()){
            $p = new pregunta($registro['enunciado'], $registro['imagen'], self::obtieneTematica($registro['tematica']));
            $p->id = $registro['id'];
            $ret[]=$p;
        }



        return $ret;

    }

    //Metodos relacionados con el examen

    public static function altaExamen(examen $r){
        $res = self::$con->prepare("Insert into autoescuela.examen values(default, :descripcion, :n_preguntas, :duracion, :activo)");

        //Inserto una pregunta, todavia sin el array de preguntas
        $descripcion = $r->descripcion;
        $duracion = $r->duracion;
        $n_preguntas = $r->n_preguntas;
        $activo = $r->activo;

        $res->bindParam(':descripcion',$descripcion);
        $res->bindParam(':duracion',$duracion);
        $res->bindParam(':n_preguntas',$n_preguntas);
        $res->bindParam(':activo',$activo);

        $res->execute();

    }

    public static function altaPreguntasExamen($e, $i){
        $p = self::obtienePregunta($i);

        $res = self::$con->prepare("Insert into autoescuela.examen_pregunta values(:id_examen, :id_pregunta)");
        $id_examen = $e->id;
        $id_pregunta = $p->id;

        $res->bindParam(':id_examen',$id_examen);
        $res->bindParam(':id_pregunta',$id_pregunta);

        $res->execute();
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

    public static function obtieneJSON_Tabla($tabla,$pag, $limit){
        $ret = array();

        $res = self::$con->query("Select * from $tabla limit $limit offset $pag");

        if($res!=null){
            $filas = $res->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($filas);
        }
    }

    public static function obtieneNumColumnas($tabla){
        $ret = array();

        $res = self::$con->query("SELECT count(*) FROM information_schema.columns WHERE table_schema = 'autoescuela' AND table_name = '$tabla'");

        if($res != false){
            $registro = $res->fetchColumn();
            return (int)$registro;
        }
    }

    public static function obtienefilas($tabla){
        $ret = array();

        $res = self::$con->query("SELECT count(*) FROM $tabla");

        if($res != false){
            $registro = $res->fetchColumn();
            return (int)$registro;
        }
    }
}