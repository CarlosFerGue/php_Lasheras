function buscarMenus(){
    let opciones = { method: "GET" };
    let parametrosFormularioTelefono = new URLSearchParams(new FormData(document.getElementById("formularioBuscarTelefono"))).toString();


    if (numeroPagina == null) {
        numeroPagina = 0;
    }


    let parametros = `controlador=Menus&metodo=buscarMenus`;

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