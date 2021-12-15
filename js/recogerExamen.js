window.addEventListener("load", function(){

    const preguntas_examen = document.getElementById("preguntas_examen");
    const siguiente = document.getElementById("siguiente");
    const anterior = document.getElementById("anterior");
    const preguntas = document.getElementById("preguntas_examen");
    const finalizar = document.getElementById("finalizar_examen");
    const idFinal = document.getElementById("idFinal").innerHTML;


    fetch('recogePreguntasExamen.php?idExamen='+idFinal+'')
        .then( res => res.json() )
        .then( datos => {
            pintaPreguntas(datos);
            creaPaginador();
        });



        siguiente.onclick = function(){
            for(let i=0; i<preguntas.children.length;i++){

                if(i!=preguntas.children.length-1){
                    if(preguntas.children[i].className == "selec"){
                        preguntas.children[i].classList.remove("selec");
                        preguntas.children[i].className="escondido";
                        preguntas.children[i+1].classList.remove("escondido");
                        preguntas.children[i+1].className="selec";
                        document.getElementById(preguntas.children[i+1].id.substr(10)).className="act";
                        document.getElementById(preguntas.children[i].id.substr(10)).className="";
                        break;
                    }
                }
            }
        }

        anterior.onclick = function(){
            for(let i=0; i<preguntas.children.length;i++){
                if(preguntas.children[i].className == "selec"){
                    if(i!=0){
                        preguntas.children[i].classList.remove("selec");
                        preguntas.children[i].className="escondido";
                        preguntas.children[i-1].classList.remove("escondido");
                        preguntas.children[i-1].className="selec";

                        document.getElementById(preguntas.children[i-1].id.substr(10)).className="act";
                        document.getElementById(preguntas.children[i].id.substr(10)).className="";
                        break;
                    }
                }
            }
        }


        finalizar.onclick = function(ev){
            ev.preventDefault();
            var respuestas = preguntas_examen.children;
            var f = [];

            for(let i=0; i<respuestas.length;i++){
                for(let j=0; i<respuestas[i].children.length-1;j++){
                    if(respuestas[i].children[j+1].children[2].checked == true){
                        f.push({"pregunta":respuestas[i].getAttribute("id").substr(10),"respuesta":{"id":respuestas[i].children[j+1].children[1].getAttribute("id").substr(26),"enunciado":respuestas[i].children[j+1].children[1].value}});
                        break;
                    }
                }

            }

            var js = JSON.stringify(f);


            //creo el formData para emviar los datos del examen
                var formData = new FormData();

                formData.append("preguntas_respuestas",js);
                formData.append("idExamen",idFinal);

                fetch("enviaExamenHecho.php",{
                    method:"POST",
                    body:formData
                })
                    .catch(error=>console.log("Error", error))
                    .then(response => {
                        if(response.ok){
                            location.href="listadoExamenes.php";
                        } else {
                            alert("Error");
                        }
                    })

        }


})






function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

//funcion para crear el paginador del examen
function creaPaginador(){
    const paginador = document.getElementById("paginador_examen");
    const preguntasCorrectas = document.getElementById("preguntasCorrectas");
    var p = document.createElement("p");
    p.className = "paginador";
    var preguntas_examen = document.getElementById("preguntas_examen");

    for(let j=0; j<preguntas_examen.children.length;j++){
        var b = document.createElement("input");
        b.setAttribute("type","button");
        b.id = preguntas_examen.children[j].getAttribute("id").substr(10);
        b.value = j;
        b.addEventListener('click', function () {
            for(let i=0; i<preguntas_examen.children.length;i++){
                if(preguntas_examen.children[i].className=="selec"){
                    preguntas_examen.children[i].className="escondido";
                }
            }

            for(let i=0; i<preguntas_examen.children.length;i++){
                if(preguntas_examen.children[i].id=="pre_examen"+this.id){
                    preguntas_examen.children[i].className="selec";

                    for(let j=0; j<paginador.children[0].children.length;j++){
                        paginador.children[0].children[j].className="";
                    }

                    this.className = "act";
                }

            }

        });

        // b.addEventListener('dblclick', function () {
        //     this.parentElement
        //     for(let i=0; i<preguntas_examen.children.length;i++){
        //         if(preguntas_examen.children[i].id=="pre_examen"+this.id){
        //             if(preguntas_examen.children[i].classList.contains('dudosa')){
        //                 preguntas_examen.children[i].classList.remove('dudosa');
        //             } else {
        //                 preguntas_examen.children[i].classList.add('dudosa');
        //             }
        //         }
        //     }
        // });
        p.appendChild(b);

        paginador.appendChild(p);

    }
}

//funcion que pinta las preguntas procedentes de la llamada ajax
function pintaPreguntas(datos){
    var i = 1;
    shuffle(datos);
    for (let valor of datos){

        var d = document.createElement("section");
        d.setAttribute("id", "pre_examen"+valor.id)

        if(i==1){
            d.className= "selec";
        } else {
            d.className = "escondido";
        }


        var t = document.createElement("textarea");
        t.setAttribute("cols","60");
        t.setAttribute("rows","5");
        t.innerHTML = valor.enunciado;
        t.setAttribute("disabled",true);
        d.appendChild(t);
        var j=1;

        shuffle(valor.respuestas);
        for(let r of valor.respuestas){

            var p = document.createElement("p");

            var label = document.createElement("label");
            label.innerHTML = "Opcion"+j+" ";

            var texto = document.createElement("input");
            texto.setAttribute("type", "text");
            texto.setAttribute("id", "pregunta_respuesta_examen_"+r.id);
            texto.setAttribute("name", "pregunta_respuesta_examen_"+r.id);
            texto.setAttribute ("value", r.enunciado);
            texto.setAttribute("disabled", true);

            var radio = document.createElement("input");
            radio.setAttribute("type", "radio");
            radio.setAttribute("id", "opcion_examen_"+j);
            radio.setAttribute("name", "opciones"+i);
            radio.setAttribute("value", "opcion"+j);
            radio.innerHTML = "Correcta";

            p.appendChild(label);
            p.appendChild(texto);
            p.appendChild(radio);


            d.appendChild(p);
            j++;
        }
        preguntas_examen.appendChild(d);

        i++;
    }
}

function pintaRespuestas(d, respuestas){
    for (let valor of respuestas){
        let i=1;

        var p = document.createElement("p");

        var label = document.createElement("label");
        label.innerHTML = "Opcion"+i;

        var texto = document.createElement("input");
        texto.setAttribute("type", "text");
        texto.setAttribute("id", "pregunta_respuesta_examen_"+i);
        texto.setAttribute("name", "pregunta_respuesta_examen_"+i);
        texto.innerHTML = valor.enunciado;
        texto.setAttribute("disabled", true);

        var radio = document.createElement("input");
        radio.setAttribute("type", "radio");
        radio.setAttribute("id", "opcion_examen_"+i);
        radio.setAttribute("name", "opciones"+i);
        radio.setAttribute("value", "opcion"+i);
        radio.innerHTML = "Correcta";

        p.appendChild(label);
        p.appendChild(texto);
        p.appendChild(radio);


        d.appendChild(p);
        i++;

    }
}

function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;

      // And swap it with the current element.
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }

    return array;
  }