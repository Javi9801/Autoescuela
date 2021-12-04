<?php
  require_once("cargadores/cargarHelper.php");
  require_once("cargadores/cargarEntidades.php");

sesion::iniciar();

if(sesion::existe('usuario')==false){
    header("location: loginUsuario.php");
} else {
    sesion::eliminar('usuario');
    sesion::destruir();
    header("Location: loginUsuario.php");
}
