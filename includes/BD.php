<?php
require_once('./entidades/usuario.php');

class BD{
    private static $con;

    public static function conecta(){
        self::$con = new PDO('mysql:host=localhost;dbname=autoescuela', 'root', '');
    }


    public static function obtieneUsuarios(){
        $ret = array();

        $res = self::$con->query("Select * from autoescuela.usuario");

        $filas = $res->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($filas);

    }

    public static function obtieneUsuario($email,$password){
        $res = self::$con->query("Select * from Autoescuela.usuario where email = '$email' and password = '$password");


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

        $res = self::$con->prepare("Insert into autoescuela.usuario values(default, :email, :nombre, :apellidos, :password, :fecha_nacimiento, :rol, :foto, :activo)");

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

    public static function bajaUsuario(usuario $u){
        $correo = $u->getCorreo();

        $res = self::$con->prepare("Delete from Tienda.users where Correo = '$correo'");
        $res->bindParam(':correo',$correo);
        $res->execute();
    }


}