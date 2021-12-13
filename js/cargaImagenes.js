window.addEventListener("load",function(){
    var fichero = this.document.getElementById("pregunta_imagen");
    var aceptar = this.document.getElementById("imagen_cargar");


    aceptar.onclick = function(ev){
        var formData = new FormData();
            

        if(fichero.files.length>0){
            formData.append("imagen",fichero.files[0]);
        }

        fetch("altaPregunta.php",{
            method:"POST",
            body:formData
        })
            .catch(error=>console.log("Error", error))
            .then(response => {
                if(response.ok){
                    
                }
            })
    }
})