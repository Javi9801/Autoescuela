<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/funcionesAdicionales.js"></script>
</head>
<body>
    <?php 
    
    require_once("cargadores/cargarHelper.php");
    require_once("cargadores/cargarEntidades.php");
    include ("includes/nav.php");
    BD::conecta();
    $examen = BD::obtieneExamen($_GET['idExamen']);

    $p = [];
    $r = [];

    $p = BD::obtienePreguntasExamen($examen->id);
    $n_preg = count($p);
    
    ?>

    <section class="contenido">     

        <?php
        
        sesion::iniciar();
        $u = sesion::leer('usuario');
        $rol = BD::obtieneRol($u->rol);

        if($rol->id==1){
        ?>

    
            <h1 class="h1_preguntas"><?php echo $examen->descripcion?></h1>

            <section id="preguntas_examen">
                <?php

                for($i=0; $i<$n_preg; $i++){
                    $r = BD::obtieneRespuestas($p[$i]->id);
                    $n_resp = count($r);
                ?>

                <section id="pre_examen<?php echo $i ?>">
                    Enunciado <br><textarea name="enun" id="enun" cols="30" rows="10"><?php echo $p[$i]->enunciado?></textarea>

                    <?php

                        for($j=1; $j<$n_resp; $j++){
                        ?>
                        
                        <p>
                            <label for="pregunta_respuesta_examen_<?php echo $j ?>">Opcion <?php echo $j ?></label>
                            <input type="text" id="pregunta_respuesta_examen_<?php echo $j ?>" name="pregunta_respuesta_examen_<?php echo $j ?>" value="<?php echo $r[$j]->enunciado ?>">
                            <input type="radio" id="opcion_examen_<?php echo $j ?>" value="opcion<?php echo $j ?>" name="opciones<?php echo $i ?>"> Correcta
                        </p>
                        <?php
                        }
                        ?>

                </section>

           

            <?php
            }

        }
        ?>
        </section>
        <input type="button" id="anterior" class="anterior" value="Anterior">
         <input type="button" id="siguiente" class="siguiente" value="Siguiente">
    </section>

    <?php include ("includes/footer.php");?>
</body>
</html>