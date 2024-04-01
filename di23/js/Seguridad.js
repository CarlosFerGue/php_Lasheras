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

function añadirPermisoMenu(id_Menu, b_nombre) {
    // Obtener el ID del elemento
    const idElemento = b_nombre.getAttribute("id");

    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=añadirPermisoMenu&id_Menu=${id_Menu}`;

    parametros += `&permiso=` + document.getElementById(idElemento).value;

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Permiso añadido');
                return res.text();
            }
        })
        .then(vista => {
            //document.getElementById("CapaResultadoBusqueda").innerHTML = vista;
        })
        .catch(err => {
            console.log("Error al realizar la petición", err.message);
        });
}

function añadirPermisoSubMenu(id_Menu, b_nombre) {
    // Obtener el ID del elemento
    const idElemento = b_nombre.getAttribute("id");

    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=añadirPermisoMenu&id_Menu=${id_Menu}`;

    parametros += `&permiso=` + document.getElementById(idElemento).value;

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Permiso añadido');
                return res.text();
            }
        })
        .then(vista => {
            //document.getElementById("CapaResultadoBusqueda").innerHTML = vista;
        })
        .catch(err => {
            console.log("Error al realizar la petición", err.message);
        });
}