
function buscar() {
    const input1 = document.getElementById("b_texto").value;
    const input2 = document.getElementById("b_telefono").value;
    console.log(input1);
    console.log(input2);
    if (input1 && !input2) {
        // Caso 1: Solo input1 tiene texto
        buscarUsuarios();
        console.log("Solo input1 tiene texto.");
    } else if (!input1 && input2) {
        buscarTelefono();
        // Caso 2: Solo input2 tiene texto
        console.log("Solo input2 tiene texto.");
    } else if (input1 && input2) {
        // Caso 3: Ambos inputs tienen texto
        buscarUsuarios();
        buscarTelefono();
        console.log("Ambos inputs tienen texto.");
    } else {
        buscarUsuarios();
        // Caso 4: Ningún input tiene texto
        console.log("Ninguno de los inputs tiene texto.");
    }
}





function buscarUsuarios() {
    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=buscarUsuarios";
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok Usuarios');
                return res.text();
            }
        })
        .then(vista => {
            document.getElementById("CapaResultadoBusqueda").innerHTML = vista;
        })
        .catch(err => {
            console.log("Error al realizar la petición", err.message);
        });
}

function buscarTelefono() {
    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=buscarTelefono";
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscarTelefono"))).toString();

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok Telefono');
                return res.text();
            }
        })
        .then(vista => {
            document.getElementById("CapaResultadoBusqueda").innerHTML = vista;
        })
        .catch(err => {
            console.log("Error al realizar la petición", err.message);
        });
}