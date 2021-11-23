<?php
require_once("helpers/sesion.php");
require_once("helpers/login.php");
require_once("entidades/usuario.php");

sesion::iniciar();
$u = sesion::leer('usuario');

?>


<header>

    <section>
        <img class="izquierda" src="recursos/logo.png" width="80px" alt="">

        <img class="derecha" src="recursos/perfil.png" width="100px" alt="">
        
        <section class="perfil">
            <ul>

                <li><a href="inicio.php">Usuario: <?php echo $u->email ?></a></li>
                <li><a href="inicio.php">Editar Usuario</a></li>
                <li><a href="inicio.php">Cerrar Sesion</a></li>
            </ul>
        </section>
    </section>

    <nav>
        <ul>
            <li class="categoria">
                <a href="#">Usuarios</a>
                <ul class="submenu">
                    <li><a href="inicio.php">Alta Usuario</a></li>
                    <li><a href="inicio.php">Alta Masiva usuarios</a></li>
                </ul>
            </li>

            <li class="categoria"><a href="#">Tematicas</a>
                <ul class="submenu">
                    <li><a href="#">Alta Tematica</a></li>
                </ul>
            </li>

            <li class="categoria"><a href="#">Preguntas</a>
                <ul class="submenu">
                    <li><a href="altaPregunta.php">Alta Pregunta</a></li>
                    <li><a href="#">Alta Masiva Preguntas</a></li>
                </ul>
            </li>

            <li class="categoria"><a href="#">Examenes</a>
                <ul class="submenu">
                    <li><a href="#">Alta Examen</a></li>
                    <li><a href="#">Historico</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>