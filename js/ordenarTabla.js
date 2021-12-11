
window.addEventListener("load", function(){
    var t = document.getElementsByClassName("tabla")[0]; 
    ordenable(t);
})


function ordenable(table){
        
        var _this = this;
        var th = table.tHead, i;
        th && (th = th.rows[0]) && (th = th.cells);

        if (th){
            i = th.length;
        }else{
            return; // si no hay thead devuelve nothing
        }

        // Recorremos cada th dentro del thead
        while (--i >= 0) (function (i) {
            var dir = 1;

            // añadimos el evento click a la funcion sort
            th[i].addEventListener('click', function () {
                sort(table, i, (dir = 1 - dir));
            });
        }(i));
    };

    function sort (table, col, reverse) {
        var tb = table.tBodies[0], // usamos tbosy para ordenar las filas del thead
        tr = Array.prototype.slice.call(tb.rows, 0), // añadimos las filas al array
        i;

        reverse = -((+reverse) || -1);

        // ordenamos filas
        tr = tr.sort(function (a, b) {
            // -1 si quieres el orden inverso
            return reverse * (
                a.cells[col].textContent.trim().localeCompare(
                    b.cells[col].textContent.trim()
                )
            );
        });

        for(i = 0; i < tr.length; ++i){
            // añadimos las filas en el orden nuevo
            tb.appendChild(tr[i]);
        }
    };
