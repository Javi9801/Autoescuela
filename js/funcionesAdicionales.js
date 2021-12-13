window.addEventListener("load", function(){
    const imagen = document.getElementById("imagen_perfil");
    const cerrar = document.getElementById("imagen_cerrar");
    const div = document.getElementById("informacion_usuario");

    var enlaces = document.getElementsByClassName("enlaces");

    for(let i=0; i<enlaces.length;i++){
        enlaces[i].onclick = function(ev){
            ev.preventDefault();
            // location.href = "index.php";
            if(enlaces[i].innerHTML =="Corregir"){
                location.href="corregirExamen.php?idExamen="+enlaces[i].getAttribute("id").substr(1)+"";
            } else {
                location.href="realizarExamen.php?idExamen="+enlaces[i].getAttribute("id").substr(1)+"";
            }
        }
    }

    imagen.onclick = function(){
        if(div.style.visibility == "hidden"){
            div.setAttribute("style", "visibility:inherit;");
        } else {
            div.style.visibility = "hidden";

        }

    }

    cerrar.onclick = function(){
        window.location.href = "loginout.php";

    }

})