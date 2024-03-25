function cargarUnScript(url) {
    return new Promise((resolve, reject) => {
        let script = document.createElement('script');
        script.src = url;
        script.onload = () => {
            // Retraso de 50 milisegundos antes de resolver la promesa.
            setTimeout(resolve, 50);
        };
        script.onerror = reject;
        document.head.appendChild(script);
    });
}

function getVistaMenuSeleccionado(controlador, metodo) {
    let opciones = { method: "GET" };
    let parametros = "controlador=" + controlador + "&metodo=" + metodo;

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok');
                return res.text();
            }
        }).then(vista => {
            document.getElementById("secContenidoPagina").innerHTML = vista;
            console.log(controlador);
            cargarUnScript('js/' + controlador + '.js')
                .then(() => {
                    // Script cargado exitosamente, ahora puedes llamar a la función correspondiente.
                    if (controlador === 'Usuarios') {
                        buscarUsuarios(1, 10);
                    } else if (controlador === 'Permisos') {
                        buscarMenus();
                    }
                })
                .catch(err => {
                    console.log("Error al cargar el script.", err.message);
                });
        }).catch(err => {
            console.log("Error al realizar la petición.", err.message);
        });
}