window.addEventListener("load", function(){

var cargar = this.document.getElementById("cargar_preguntas");
var preguntas = document.getElementById("contenedor_preguntas");
var preguntas_examen = document.getElementById("contenedor_preguntas_examen");
    cargar.onclick = function(ev){

        ev.preventDefault();
        fetch('cargaPreguntas.php')
        .then( res => res.json() )
        .then( datos => {
            pintaDatos(datos);
        });

    }

    function pintaDatos(datos){
        preguntas.innerHTML = "";
        preguntas_examen.innerHTML = "";

        for (let valor of datos){

            var d = document.createElement("div");
            d.innerHTML = valor.id+"-->"+valor.enunciado+"--->"+valor.tematica;
            preguntas.appendChild(d);

        }
    }
})