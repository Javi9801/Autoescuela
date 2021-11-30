<?php
spl_autoload_register(function($clase){
    $aux = substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/'));
    $aux = substr($aux,0,strrpos($aux,'/'));
    $fichero = $_SERVER['DOCUMENT_ROOT'].$aux.'/entidades/'.$clase.'.php';
    if(file_exists($fichero)){
        require_once $fichero;
    }

});