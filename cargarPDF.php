<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

require_once("cargadores/cargarHelper.php");
require_once("cargadores/cargarEntidades.php");
require_once("cargadores/cargarIncludes.php");
BD::conecta();
$examen = BD::obtieneExamen($_GET["idExamen"]);
$respuestasRespondidas = [];
$respuestasRespondidas = JSON_decode(BD::obtieneIdExamenHecho($_GET["idExamen"]));
$nota = 0;

foreach($respuestasRespondidas as $i){
    $c = BD::obtieneRespuestaCorrecta($i->pregunta);
    if($i->respuesta->id == $c){
        $nota++;
    }
}

$html='
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Pedazo de PDF</title>
</head>
<body>

<h2>Resultado Examen</h2>
<p>Has sacado un '.$nota.' de '.count($respuestasRespondidas).'</p>

</body>
</html>';
$mipdf = new Dompdf();
# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
$mipdf ->set_paper("A4", "portrait");
# Cargamos el contenido HTML.
$mipdf ->load_html($html);

# Renderizamos el documento PDF.
$mipdf ->render();

# Creamos un fichero
$pdf = $mipdf->output();
$filename = "Ejemplo.pdf";
file_put_contents($filename, $pdf);

# Enviamos el fichero PDF al navegador.
$mipdf->stream($filename);
?>