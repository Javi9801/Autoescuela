window.addEventListener("load", function(){
 
    const caja = document.getElementById("fileOutput1");

    document.getElementById("enviar_archivo_preguntas").onclick = function(ev){
        debugger;
        var contenido = caja.value.replaceAll("\"","");
        var filas = contenido.split("\n");
        var preguntas = Array();
        
       
        for(let i=0; i<filas.length;i++){
            let partes = filas[i].split(";");
            for(let j=0;j<partes.length;j++){
                if(preguntas[i]==undefined){
                    preguntas[i] = partes;
                }  
            }
            
           
        }   

        var preguntas_json = JSON.stringify(preguntas);

        var formData = new FormData();

           
            
            formData.append("preguntas",preguntas_json);
            formData.append("n_preguntas",preguntas.length);
            fetch("altaMasivaPreguntas.php",{
                method:"POST",
                body:formData
            })
                .then(response => response.JSON())
                .catch(error=>console.log("Error", error))
                .then(response => {
                    if(response.respuesta){
                        caja.innerHTML="";
                        alert("Mandado con exito");
                    } else {
                        alert("Error");
                    }
                })
    }
})