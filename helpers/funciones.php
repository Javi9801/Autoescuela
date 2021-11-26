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

        $select = "<select name='$idsel' id='$idsel'>";

        while($registro = $vec->fetch()){
            $id = $registro[0];
            $des = $registro[1];
            $select .="<option value='$id'>".$des."</option>";
        }
        $select .= "</select>";

        return $select;
    }

    public static function pintaTabla($tabla, $columnas){

        $json = BD::obtieneJSON_Tabla($tabla);

        $vector = json_decode($json);

        $html = '<table>';


        foreach($columnas as $i){
            $html+='<tr>
            <th>'.$i[0].'</th>';

        }
        $html+='</tr>';


        foreach($vector as $i){
            $html+='<tr>
                <td>'.$i['id'].'</td>
                <td>'.$i['enunciado'].'</td>
                <td>'.$i['tematica'].'</td>
                </tr>';
        }

        $html+='</tr>';

        return $html;
    }

}