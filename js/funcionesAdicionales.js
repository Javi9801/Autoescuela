window.addEventListener("load", function(){
    const imagen = document.getElementById("imagen_perfil");
    const div = document.getElementById("informacion_usuario");
    const preguntas = document.getElementById("preguntas_examen");
    const siguiente = document.getElementById("siguiente");
    const anterior = document.getElementById("anterior");

    this.document.getElementById("pre_examen0").className="selec";

    for(let i=1; i<preguntas.children.length;i++){
        var aux = i+1+"";
        var p = "pre_examen"+i;
        document.getElementById(p).className= "escondido";
    }

    imagen.onclick = function(){
        if(div.style.visibility == "hidden"){
            div.setAttribute("style", "visibility:inherit;");
        } else {
            div.style.visibility = "hidden";

        }

    }

    siguiente.onclick = function(){
        for(let i=0; i<preguntas.children.length;i++){

            if(i!=preguntas.children.length-1){
                if(preguntas.children[i].className == "selec"){
                    preguntas.children[i].classList.remove("selec");
                    preguntas.children[i].className="escondido";
                    preguntas.children[i+1].classList.remove("escondido");
                    preguntas.children[i+1].className="selec";
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
                    break;
                }
            }
        }
    }

})