window.addEventListener("load", function(){
    const preguntas_examen = document.getElementById("preguntas_examenH");
    var id = document.getElementById("idFinalH").innerHTML;
    const siguiente = document.getElementById("siguienteH");
    const anterior = document.getElementById("anteriorH");
    const preguntas = document.getElementById("preguntas_examenH");


    fetch('recogePreguntasExamen.php?idExamen='+id+'')
    .then( res => res.json() )
    .then( datos => {
        pintaP(datos);
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



})

function pintaP(datos){
    const preguntas_examen = document.getElementById("preguntas_examenH");
    var i = 1;
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

function creaPaginador(){
    const paginador = document.getElementById("paginador_examenH");
    var p = document.createElement("p");
    p.className = "paginador";
    var preguntas_examen = document.getElementById("preguntas_examenH");
    const respuestasCorrectas = document.getElementById("preguntasCorrectas");

    for(let j=0; j<preguntas_examen.children.length;j++){
        var b = document.createElement("input");
        b.setAttribute("type","button");
        b.id = "_"+ preguntas_examen.children[j].getAttribute("id").substr(10);
        b.value = j;7




        for(let k=0; k<respuestasCorrectas.children.length;k++){
            if(b.id.substr(1) == respuestasCorrectas.children[k].id.substr(5)){
                if(respuestasCorrectas.children[k].getAttribute("resp") == respuestasCorrectas.children[k].value){
                    b.classList.add("correcto");
                } else {
                    b.classList.add("incorrecto");
                }
            }
        }

        p.appendChild(b);

        paginador.appendChild(p);

    }
}