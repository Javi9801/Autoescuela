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
            for(let i=1; i<preguntas.length;i++){
                p.push(preguntas[i]);
            }
            formData.append("descripcion",descripcion.value);
            formData.append("duracion",duracion.value);
            formData.append("preguntas",p);
            formData.append("n_preguntas",preguntas.length-1);

            fetch("procesaExamen.php",{
                method:"POST",
                body:formData
            })
                .then(response => response.JSON())
                .catch(error=>console.log("Error", error))
                .then(response => {
                    if(response.respuesta){
                        alert("Mandado con exito");
                    } else {
                        alert("Error");
                    }
                })
        }
    }
})
