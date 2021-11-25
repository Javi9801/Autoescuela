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

        for (let valor of datos){

            var d = document.createElement("div");
            d.innerHTML = valor.id+"-->"+valor.enunciado+"--->"+valor.tematica;
            d.setAttribute("id", valor.id);
            d.setAttribute("dragable", true);
            //d.setAttribute("ondragstart", drag(event));

            d.ondrag = function(ev){
                ev.dataTransfer.setData("text", ev.target.id);
            };

            preguntas.appendChild(d);

        }
    }

    preguntas_examen.allowDrop = function(ev){
        ev.preventDefault();
    }

    preguntas_examen.drop = function(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }

})



