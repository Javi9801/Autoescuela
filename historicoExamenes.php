<?php
  require_once("helpers/sesion.php");
  require_once("helpers/BD.php");
  require_once("helpers/login.php");

sesion::iniciar();
BD::conecta();

var_dump(BD::obtieneUsuariosJSON());
