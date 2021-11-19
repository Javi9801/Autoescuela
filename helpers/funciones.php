<?php
require_once("BD.php");
require_once("./entidades/tematica.php");
class Funciones{
    public static function validarLogin($var1, $var2){
        $errores = [];

        if($var1==""){
            $errores["'$var1'"] = "Error, email no puede ser nulo";
        }

        if($var2==""){
            $errores["'$var2'"] = "Error, contraseña no puede ser nulo";
        }


        return $errores;
    }

    public static function selectDinamico($idsel, $tabla){
        BD::conecta();
        $vec = BD::obtieneTabla($tabla);

        $select = "<select name=".$idsel." id=".$idsel.">";

        while($registro = $vec->fetch()){
            $select +="<option value=".$registro[0].">".
            $registro[1]."</option>";

            var_dump($registro);
        }
        $select = "</select>";

        return $select;
    }
}