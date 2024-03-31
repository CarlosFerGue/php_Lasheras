function buscarMenusCards() {
    let opciones = { method: "GET" };

    //let parametrosFormulario = new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

    //let parametros = `controlador=Seguridad&metodo=buscarMenusCards=${parametrosFormulario}`;
    let parametros = `controlador=Seguridad&metodo=buscarMenusCards`;

    //console.log(parametros);

    fetch(`C_Ajax.php?${parametros}`, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok Menus');
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