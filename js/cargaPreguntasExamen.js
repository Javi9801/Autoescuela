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


        preguntas_examen.ondragover = function(ev){
            ev.preventDefault();
        }

        preguntas_examen.ondrop = function(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }


    }

    function pintaDatos(datos){
        preguntas.innerHTML = "";

        for (let valor of datos){

            var d = document.createElement("div");
            d.innerHTML = valor.id+"-->"+valor.enunciado+"--->"+valor.tematica;
            d.setAttribute("id", valor.id);
            d.setAttribute("dragable", true);
            //d.setAttribute("ondragstart", drag(event));

            d.ondragstart = function(ev){
                ev.dataTransfer.setData("text", ev.target.id);
            };

            preguntas.appendChild(d);

        }
    }
})



