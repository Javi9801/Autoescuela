window.addEventListener("load", function(){
    const preguntas_examen = document.getElementById("preguntas_examenH");
    var id = getParameterByName("idExamen");
    const siguiente = document.getElementById("siguienteH");
    const anterior = document.getElementById("anteriorH");
    const idFinal = document.getElementById("idFinalH").innerHTML;


    fetch('recogePreguntasExamen.php?idExamen='+id+'')
    .then( res => res.json() )
    .then( datos => {
        pintaPreguntas(datos);
        creaPaginador();
    });




})