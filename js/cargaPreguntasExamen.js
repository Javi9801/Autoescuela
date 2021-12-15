window.addEventListener("load", function(){

    fetch('cargaPreguntas.php')
        .then( res => res.json() )
        .then( datos => {
            pintaDatos(datos);
        });


    // var cargar = this.document.getElementById("cargar_preguntas");
    var preguntas = document.getElementById("contenedor_preguntas");
    var preguntas_examen = document.getElementById("contenedor_preguntas_examen");
    const izq = document.getElementById("contenedor_preguntas");
    const divs=izq.getElementsByTagName("div");
    const marcados = this.document.getElementById("marcados");

    const filtro=document.getElementById("texto");

    filtro.onkeyup=function(){

        for(let i=0;i<divs.length;i++){
            divs[i].classList.remove("marcado");
            if(divs[i].innerHTML.indexOf(filtro.value)<0)
                divs[i].classList.add("oculto")
            else
                divs[i].classList.remove("oculto")
        }
    }



    // cargar.onclick = function(ev){

    //     ev.preventDefault();
    //     fetch('cargaPreguntas.php')
    //     .then( res => res.json() )
    //     .then( datos => {
    //         pintaDatos(datos);
    //     });
    // }

    for (let i=0;i<divs.length;i++){

        divs[i].ondragover = function(ev){
            ev.preventDefault();
        }

        divs[i].ondrop = function(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }

        divs[i].ondragstart=function(ev){
            ev.dataTransfer.setData("text",ev.target.id)
        };


    }

    preguntas.ondragover = function(ev){
        ev.preventDefault();
    }

    preguntas.ondrop = function(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }


    preguntas_examen.ondragover = function(ev){
        ev.preventDefault();
    }

    preguntas_examen.ondrop = function(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }

    function pintaDatos(datos){
        preguntas.innerHTML = "<h1>Preguntas</h1>";
        for (let valor of datos){

            var d = document.createElement("div");
            d.innerHTML = "ID: "+valor.id+" <br>Enunciado: "+valor.enunciado+"<br>Tematica: "+valor.tematica.descripcion;
            d.setAttribute("id", 'p_'+valor.id);
            d.setAttribute("draggable", true);
            //d.setAttribute("ondragstart", drag(event));

            d.ondragstart = function(ev){
                ev.dataTransfer.setData("text", ev.target.id);
            };

            d.ondrop = function(){
                var data = ev.dataTransfer.getData("text");
                ev.target.parentElement.appendChild(document.getElementById(data));

            }

            d.ondragover = function(ev){
                ev.preventDefault();
            }

            d.onmouseover = function(ev){
                this.style.cursor = 'grab';
                this.style.color = '#FF0000';
            }

            d.onmouseout = function(ev){
                this.style.color="black";
            }

            d.ondblclick = function(){
                this.classList.add("marcado");
            }
            preguntas.appendChild(d);

        }
    }

    marcados.onclick = function(){
        var preguntas_marcadas = document.getElementsByClassName("marcado");

        for(let i=0; i<preguntas_marcadas.length-1;i++){
            preguntas_examen.appendChild(preguntas_marcadas[i]);
        }
    }   
})



