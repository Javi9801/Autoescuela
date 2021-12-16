window.addEventListener("load", function(){

    const caja = document.getElementById("fileOutput");

    document.getElementById("enviar_archivo_usuarios").onclick = function(ev){
        debugger;
        var contenido = caja.value.replaceAll("\"","");
        var filas = contenido.split("\n");
        var usuarios = Array();


        for(let i=0; i<filas.length;i++){
            let partes = filas[i].split(";");
            for(let j=0;j<partes.length;j++){
                if(usuarios[i]==undefined){
                    usuarios[i] = partes;
                }
            }


        }

        var usuarios_json = JSON.stringify(usuarios);

        var formData = new FormData();



            formData.append("usuarios",usuarios_json);
            formData.append("n_usuarios",usuarios.length);
            fetch("altaMasivaUsuarios.php",{
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

                window.location.href="listadoUsuarios.php";
    }
})