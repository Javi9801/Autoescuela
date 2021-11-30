<?php
require_once("sesion.php");
require_once("BD.php");
require_once("../entidades/usuario.php");

class Login {
    public static function identifica(string $usuario,string $contrasena,bool $recuerdame){
        if(self::existeusuario($usuario,$contrasena)){
            Sesion::iniciar();
            Sesion::escribir('login',$usuario);
            if($recuerdame){
                setcookie('recuerdame',$usuario,time()+30*24*60*60);
            }
            return true;
        }
        return false;
    }

    private static function existeUsuario(string $usuario,string $password=null){
        BD::conecta();
        return BD::existeusuario($usuario,$password);
    }

    public static function usuarioEstaLogueado(){
        if(Sesion::leer('login')){
            return true;
        }
        elseif(isset($_COOKIE['recuerdame']) && self::ExisteUsuario($_COOKIE['recuerdame'])){
            Sesion::iniciar();
            Sesion::escribir('login',$_COOKIE['recuerdame']);
            return true;
        }
        return false;
    }
}