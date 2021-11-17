<?php
  require_once("includes/sesion.php");
  require_once("includes/BD.php");
  require_once("includes/login.php");

sesion::iniciar();
BD::conecta();

var_dump(BD::obtieneUsuarios());
