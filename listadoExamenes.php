<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/ordenarTabla.js"></script>
    <script src="js/funcionesAdicionales.js"></script>
</head>
<body>
    <?php include ("includes/nav.php");?>

    <section class="contenido">


        <h1 class="h1_preguntas">Listado Examenes</h1>



        <?php
        require_once("cargadores/cargarHelper.php");
        require_once("cargadores/cargarEntidades.php");

        sesion::iniciar();
        $u = sesion::leer('usuario');
        BD::conecta();
        $rol = BD::obtieneRol($u->rol);


        if(isset($_GET['pag'])){
            $pag = $_GET['pag'];
            $total = 4*$pag;
            $menos1=$pag-1;
            if($pag==0){
                $menos1 = $pag;
            }
            $mas1 = $pag+1;


        } else {
            $pag = 0;
            $total = 0;
            $menos1 = $pag-1;
            $mas1 = $pag+1;
        }

        $cabeceras = array("Id","Descripcion", "Nº Preguntas", "Duracion", "Activado", "Acciones");

        $tabla =  Funciones::pintaTablaExamenes("Autoescuela.examen", $cabeceras, $total, 4, $rol->id);
        echo $tabla;


        $registros = BD::obtienefilas("Autoescuela.examen");
        $enlace = '<p class="paginador">';
        $aux = round($registros/4);
        $act = "";

        $enlace.= "<a href='listadoExamenes.php?pag=0'>&lt;&lt;</a>";

        $enlace.= "<a href='listadoExamenes.php?pag=$menos1'>&lt;</a>";

        for($i=0; $i<$aux;$i++){
            if($pag == $i){
                $act = "activo";
            } else {
                $act = "noActivo";
            }
            $enlace.="<a class='$act' href='listadoExamenes.php?pag=$i'>$i</a>";
        }

        $enlace.= "<a href='listadoExamenes.php?pag=$mas1'>&gt;</a>";

        $t = $aux-1;
        $enlace.= "<a href='listadoExamenes.php?pag=$t'>&gt;&gt;</a>";

        $enlace.= '</p>';
        ?>
    </section>


    <div><?php echo $enlace ?></div>

    <?php include ("includes/footer.php");?>
</body>
</html>