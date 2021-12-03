window.addEventListener("load", function(){

    var preguntas = document.getElementById("contenedor_preguntas_examen").children;
    var duracion = document.getElementById("examen_duracion");
    var descripcion = document.getElementById("examen_descripcion");
    var enviar = document.getElementById("examen_enviar");

    enviar.onclick = function(ev){
        ev.preventDefault();

        if(duracion.value != "" && descripcion.value!="" && preguntas!=""){
            var formData = new FormData();

            var p = new Array();
            for(let i=1; i<preguntas.length;i++){
                var ids = preguntas[i].innerHTML.substr(0,1);
                p.push(ids);
            }
            formData.append("descripcion",descripcion.value);
            formData.append("duracion",duracion.value);
            formData.append("preguntas",p);
            var l = preguntas.length-1;
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

            document.getElementById("form_examen").reset();
            document.getElementById("contenedor_preguntas_examen").innerHTML="<h1>Contenedor</h1>";
            document.getElementById("contenedor_preguntas").innerHTML="<h1>Preguntas</h1>";
        }
    }
})
