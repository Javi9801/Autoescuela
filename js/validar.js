window.addEventListener("load", function(){


    const submit = document.getElementsByClassName("btn_form");
    const campos = document.getElementsByClassName("campos"); //los inputs que tienen datos del formulario
    const letras = document.getElementsByClassName("letras");  //los inputs que solo pueden tener letras en el formulario
    let repeticion = this.setInterval(validaFormulario,1000);

    function validaFormulario(){
        var j =0;
        for(let i=0; i<campos.length;i++){
            if(campos[i].value.length==0){
                submit[0].setAttribute("disabled", true);
                campos[i].classList.add("error");
            } else {
                campos[i].classList.remove("error");
                j++;

                if(j==campos.length){
                    submit[0].removeAttribute("disabled");
                }
            }
        }
    }


    for(let i=0; i<letras.length;i++){
        letras[i].onkeydown = function(ev){
            if(!isNaN(ev.key)){
                ev.preventDefault();
            }
        }
    }
});