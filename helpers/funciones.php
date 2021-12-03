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

    public static function selectDinamico($idsel, $tabla, $t=""){
        BD::conecta();
        $vec = BD::obtieneTabla($tabla);

        $select = "<select name='$idsel' id='$idsel'>";

        while($registro = $vec->fetch()){
            $id = $registro[0];
            $des = $registro[1];

            if($t==$id){
                $selected = "selected";
            } else{
                $selected = "";
            }

            $select .="<option value='$id'>".$des."</option>";
        }
        $select .= "</select>";

        return $select;
    }

    public static function pintaTablaPreguntas($tabla, $columnas, $pag, $limit){

        $json = BD::obtieneJSON_Tabla($tabla, $pag, 4);

        $vector = json_decode($json, true);

        $html = '<table class="tabla"><tr>';


        foreach($columnas as $i){
            $html.='<th>'.$i.'</th>';

        }
        $html.='</tr>';


        foreach($vector as $i){
            $html.='<tr>';
            $html.='<td>'.$i['id'].'</td>';
            $html.='<td>'.$i['enunciado'].'</td>';
            $html.='<td>'.BD::obtieneTematica($i['tematica'])->descripcion.'</td>';
            $html.='<td><a href="verPregunta.php?idPregunta='.$i['id'].'"><img src="./recursos/perfil.png" width="50px"></a></td>';
            $html.='</tr>';
            }

            $html.='</table>';

        return $html;
    }

    public static function pintaTablaUsuarios($tabla, $columnas, $pag, $limit){

        $json = BD::obtieneJSON_Tabla($tabla, $pag, 4);

        $vector = json_decode($json, true);

        $html = '<table class="tabla"><tr>';


        foreach($columnas as $i){
            $html.='<th>'.$i.'</th>';

        }
        $html.='</tr>';


        foreach($vector as $i){
            $html.='<tr>';
            $html.='<td>'.$i['id'].'</td>';
            $html.='<td>'.$i['email'].'</td>';
            $html.='<td>'.$i['nombre'].'</td>';
            $html.='<td>'.$i['apellidos'].'</td>';
            $html.='<td>'.$i['fecha_nacimiento'].'</td>';
            $html.='<td>'.BD::obtieneRol($i['rol'])->descripcion.'</td>';
            $html.='<td>'.$i['foto'].'</td>';
            $html.='<td>'.$i['activo'].'</td>';
            $html.='<td><a href="verUsuario.php?idUsuario='.$i['id'].'"><img src="./recursos/perfil.png" width="50px"></a></td>';
            $html.='</tr>';
            }

            $html.='</table>';

        return $html;
    }

}