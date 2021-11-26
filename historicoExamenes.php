<?php
require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");
sesion::iniciar();
BD::conecta();

var_dump(BD::obtieneUsuariosJSON());
