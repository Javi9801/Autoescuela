window.addEventListener("load", function(){
    
    var preguntas = document.getElementById("contenedor_preguntas_examen").children;
    var duracion = document.getElementById("examen_duracion");
    var descripcion = document.getElementById("examen_descripcion");
    var enviar = document.getElementById("examen_enviar");


    enviar.onclick = function(ev){
        ev.preventDefault();

        if(duracion.value != "" && descripcion.value!="" && preguntas!=""){
            var formData = new FormData();

            var p = [];
            for(let i=1; i<preguntas.children.length;i++){
                p.push(preguntas.children[i]);
            }
            formData.append("descripcion",descripcion.value);
            formData.append("duracion",duracion.value);
            formData.append("preguntas",JSON.stringify(p));
            formData.append("n_preguntas",preguntas.children.length-1);

            fetch("altaExamen.php",{
                method:"POST",
                body:formData
            })
                .then(response => response.JSON())
                .catch(error=>console.log("Error", error))
                .then(response => {
                    if(response.respuesta){
                        alert("Mandado con exito");
                    }
                })
        }
    }
})
