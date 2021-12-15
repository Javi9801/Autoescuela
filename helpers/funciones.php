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

        $html = '<table id="tablaPregunta" class="tabla"><thead><tr>';


        foreach($columnas as $i){
            $html.='<th>'.$i.'</th>';

        }
        $html.='</tr></thead>';


        foreach($vector as $i){
            $html.='<tr>';
            $html.='<td>'.$i['id'].'</td>';
            $html.='<td>'.$i['enunciado'].'</td>';
            $html.='<td>'.BD::obtieneTematica($i['tematica'])->descripcion.'</td>';
            $html.='<td><img src="data:image/jpg;base64,'.$i["imagen"].'"width=100px"></td>';
            $html.='<td><a href="verPregunta.php?idPregunta='.$i['id'].'"><img src="./recursos/editar.png" width="30px"></a><a href="eliminarPregunta.php?idPregunta='.$i['id'].'"><img src="./recursos/eliminar.png" width="30px"></a></td>';
            $html.='</tr>';
            }

            $html.='</table>';

        return $html;
    }

    public static function pintaTablaUsuarios($tabla, $columnas, $pag, $limit){

        $json = BD::obtieneJSON_Tabla($tabla, $pag, 4);

        $vector = json_decode($json, true);

        $html = '<table id="tablaUsuario" class="tabla"><thead><tr>';


        foreach($columnas as $i){
            $html.='<th>'.$i.'</th>';

        }
        $html.='</tr></thead>';


        foreach($vector as $i){
            $html.='<tr>';
            $html.='<td>'.$i['id'].'</td>';
            $html.='<td>'.$i['email'].'</td>';
            $html.='<td>'.$i['nombre'].'</td>';
            $html.='<td>'.$i['apellidos'].'</td>';
            $html.='<td>'.$i['fecha_nacimiento'].'</td>';
            $html.='<td>'.BD::obtieneRol($i['rol'])->descripcion.'</td>';
            $html.='<td><img src="data:image/jpg;base64,'.$i["foto"].'"width=100px"></td>';
            $html.='<td>'.$i['activo'].'</td>';
            $html.='<td><a href="verUsuario.php?idUsuario='.$i['id'].'"><img src="./recursos/editar.png" width="30px"></a></td>';
            $html.='</tr>';
            }

            $html.='</table>';

        return $html;
    }

    public static function pintaTablaExamenes($tabla, $columnas, $pag, $limit, $rol){

        $json = BD::obtieneJSON_Tabla($tabla, $pag, 4);

        $vector = json_decode($json, true);

        $html = '<table id="tablaExamen" class="tabla"><thead><tr>';


        foreach($columnas as $i){
            $html.='<th>'.$i.'</th>';

        }
        $html.='</tr></thead>';


        foreach($vector as $i){
            $html.='<tr>';
            $html.='<td>'.$i['id'].'</td>';
            $html.='<td>'.$i['descripcion'].'</td>';
            $html.='<td>'.$i['n_preguntas'].'</td>';
            $html.='<td>'.$i['duracion'].'</td>';
            $html.='<td>'.$i['activo'].'</td>';

            if($rol==1){
                $html.='<td><a class="enlaces" id=_'.$i['id'].' href="realizarExamen.php?idExamen='.$i['id'].'">Realizar</a></td>';
            } else {
                $html.='<td><a id=_'.$i['id'].' href="verExamen.php?idExamen='.$i['id'].'"><img src="./recursos/editar.png" width="30px"></a></td>';
            }
            $html.='</tr>';
            }

            $html.='</table>';

        return $html;
    }

    public static function pintaTablaExamenesHechos($tabla, $columnas, $pag, $limit, $rol){

        $json = BD::obtieneJSON_Tabla($tabla, $pag, 4);

        $vector = json_decode($json, true);

        $html = '<table id="tablaExamenesHechos" class="tabla"><thead><tr>';


        foreach($columnas as $i){
            $html.='<th>'.$i.'</th>';

        }
        $html.='</tr></thead>';


        foreach($vector as $i){
            $html.='<tr>';
            $html.='<td>'.$i['id'].'</td>';
            $html.='<td>'.$i['id_examen'].'</td>';
            $html.='<td>'.BD::obtieneUsuarioExamen($i['id_alumno'])->email.'</td>';
            $html.='<td>'.$i['fecha'].'</td>';
            $html.='<td>'.$i['calificacion'].'</td>';

            $html.='<td><a class="" id=_'.$i['id'].' href="corregirExamen.php?idExamen='.$i['id_examen'].'">Corregir  </a><a class="" id=_'.$i['id'].' title="cargar PDF" href="cargarPDF.php?idExamen='.$i['id_examen'].'"><img src="./recursos/pdf.png" width="30px"></a></td>';
            $html.='</tr>';
            }

            $html.='</table>';

        return $html;
    }

}