window.addEventListener("load", function(){
    const imagen = document.getElementById("imagen_perfil");
    const div = document.getElementById("informacion_usuario");


    imagen.onclick = function(){
        if(div.style.visibility == "hidden"){
            div.setAttribute("style", "visibility:inherit;");
        } else {
            div.style.visibility = "hidden";

        }

    }

})