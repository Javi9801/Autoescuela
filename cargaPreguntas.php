<?php
require_once("helpers/BD.php");



BD::conecta();



if(BD::obtienePreguntasJSON()!=null){
    echo BD::obtienePreguntasJSON();
    return true;

} else {
    return false;
}