<?php
require_once("helpers/sesion.php");
require_once("helpers/login.php");
require_once("entidades/usuario.php");

sesion::iniciar();
$u = sesion::leer('usuario');

if($u->rol == "2"){

?>
    <header>

        <section>
            <img class="izquierda" src="recursos/logo.png" width="120px" height="80px" alt="">

            <img class="derecha" id="imagen_perfil" src="recursos/perfil.png" width="100px" alt="">

            <section id="informacion_usuario" class="perfil">
                <ul>

                    <li><a href="inicio.php">Usuario: <?php echo $u->email ?></a></li>
                    <li><a href="inicio.php">Editar Usuario</a></li>
                    <li><a href="loginout.php">Cerrar Sesion</a></li>
                </ul>
            </section>
        </section>

        <nav>
            <ul>
                <li class="categoria"><a href="listadoUsuarios.php?pag=0">Usuarios</a>
                    <ul class="submenu">
                        <li><a href="altaUsuario.php">Alta Usuario</a></li>
                        <li><a href="inicio.php">Alta Masiva usuarios</a></li>
                    </ul>
                </li>

                <li class="categoria"><a href="#">Tematicas</a>
                    <ul class="submenu">
                        <li><a href="#">Alta Tematica</a></li>
                    </ul>
                </li>

                <li class="categoria"><a href="listadoPreguntas.php?pag=0">Preguntas</a>
                    <ul class="submenu">
                        <li><a href="altaPregunta.php">Alta Pregunta</a></li>
                        <li><a href="#">Alta Masiva Preguntas</a></li>
                    </ul>
                </li>

                <li class="categoria"><a href="listadoExamenes.php">Examenes</a>
                    <ul class="submenu">
                        <li><a href="altaExamen.php">Alta Examen</a></li>
                        <li><a href="#">Historico</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

<?php

} else {
    if($u->rol = "1"){
    ?>
    <header>

<section>
    <img class="izquierda" src="recursos/logo.png" width="80px" alt="">

    <img class="derecha" id="imagen_perfil" src="recursos/perfil.png" width="100px" alt="">

    <section id="informacion_usuario" class="perfil">
        <ul>

            <li><a href="inicio.php">Usuario: <?php echo $u->email ?></a></li>
            <li><a href="inicio.php">Editar Usuario</a></li>
            <li><a href="loginout.php">Cerrar Sesion</a></li>
        </ul>
    </section>
</section>

<nav>
    <ul>
        <li class="categoria"><a href="#">Historico Examenes</a>
        </li>
        <li class="categoria"><a href="#">Examen aleatorio</a>
        </li>
        <li class="categoria"><a href="listadoExamenes.php">Examenes</a>
        </li>

    </ul>
</nav>
</header>
    <?php
    }
}