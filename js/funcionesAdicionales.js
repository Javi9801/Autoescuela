window.addEventListener("load", function(){
    const imagen = document.getElementById("imagen_perfil");
    const div = document.getElementById("informacion_usuario");

    var enlaces = document.getElementsByClassName("enlaces");

    for(let i=0; i<enlaces.length;i++){
        enlaces[i].onclick = function(ev){
            ev.preventDefault();
            alert(enlaces[i].getAttribute("id").substr(1));
            // location.href = "index.php";
            location.href="realizarExamen.php?idExamen="+enlaces[i].getAttribute("id").substr(1)+"";


        }
    }

    imagen.onclick = function(){
        if(div.style.visibility == "hidden"){
            div.setAttribute("style", "visibility:inherit;");
        } else {
            div.style.visibility = "hidden";

        }

    }

})