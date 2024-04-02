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

function añadirPermisoMenu(id_Menu, nombreMenu) {
    // Obtener el valor del permiso
    const permiso = document.getElementById(`${nombreMenu}`).value;

    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=añadirPermisoMenu&id_Menu=${id_Menu}`;

    parametros += `&permiso=${permiso}`;

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Permiso añadido');
                buscarMenusCards();
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

function añadirPermisoSubMenu(id_Menu, nombreSubMenu) {
    // Obtener el valor del permiso
    const permiso = document.getElementById(`${nombreSubMenu}`).value;

    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=añadirPermisoMenu&id_Menu=${id_Menu}`;

    parametros += `&permiso=${permiso}`;

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Permiso añadido');
                buscarMenusCards();
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

function borrarPermiso(id_Menu, permiso){
    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=borrarPermisoMenu&id_Menu=${id_Menu}&permisos=${permiso}`;
    // Cambiado permisos por permiso
    
    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
    .then(res => {
        if (res.ok) {
            console.log('Permiso eliminado');
            buscarMenusCards();
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

