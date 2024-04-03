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

    // Verificar si el campo de permiso está vacío
    if (!permiso.trim()) {
        console.log('El campo de permiso está vacío. No se añadirá ningún permiso.');
        return; // Salir de la función si el campo está vacío
    }

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

    // Verificar si el campo de permiso está vacío
    if (!permiso.trim()) {
        console.log('El campo de permiso está vacío. No se añadirá ningún permiso.');
        return; // Salir de la función si el campo está vacío
    }

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

function borrarPermiso(id_Menu, permiso) {
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

function mostrarPopup() {
    document.getElementById('popup2').style.display = 'block';
}

function cerrarPopup() {
    document.getElementById('popup2').style.display = 'none';
}

function eliminarMenu(id_Menu) {
    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=borrarMenu&id_Menu=${id_Menu}`;

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Menu eliminado');
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


function editarPermiso(id_Menu, permiso) {
    // Mostrar el popup de edición
    mostrarPopup();

    // Rellenar el campo de entrada con el permiso actual
    document.getElementById('nuevoPermiso').value = permiso;

    // Guardar el ID del menú y el permiso actual para usarlos en la función de guardarNuevoPermiso()
    document.getElementById('popup2').dataset.idMenu = id_Menu;
    document.getElementById('popup2').dataset.permisoActual = permiso;
}

function guardarNuevoPermiso() {
    // Obtener el nuevo valor del permiso desde el campo de entrada
    const nuevoPermiso = document.getElementById('nuevoPermiso').value;

    // Obtener el ID del menú y el permiso actual desde los atributos de datos del popup
    const id_Menu = document.getElementById('popup2').dataset.idMenu;
    const permisoActual = document.getElementById('popup2').dataset.permisoActual;

    // Verificar si el nuevo permiso es diferente al permiso actual
    if (nuevoPermiso.trim() !== permisoActual) {
        // Llamar a la función para guardar el nuevo permiso
        guardarPermiso(id_Menu, permisoActual, nuevoPermiso);
    }

    // Cerrar el popup después de guardar el permiso
    cerrarPopup();
}

function guardarPermiso(id_Menu, permisoActual, nuevoPermiso) {

    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=editarPermisoMenu&id_Menu=${id_Menu}&permisos=${permisoActual}&permisoNuevo=${nuevoPermiso}`;

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Permiso editado');
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



function añadirMenu(esSubmenu, id_Menu, posicion) {

    if (esSubmenu == 0) {
        const nombreMenu = document.getElementById(`nombreMenu_${id_Menu}`).value; // Obtener el valor del cuadro de texto
        añadirMenuEnBaseDeDatos(id_Menu,posicion, nombreMenu);
        

    } else {
        const nombreMenu = document.getElementById(`nombreSubMenu_${id_Menu}`).value; // Obtener el valor del cuadro de texto
        añadirSubMenuEnBaseDeDatos(id_Menu, posicion, nombreMenu);

    }

}

function añadirMenuEnBaseDeDatos(id_Menu, posicion, nombreMenu) {

    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=añadirMenus&id_Menu=${id_Menu}&posicion=${posicion}&nombreMenu=${nombreMenu}`;
    // Cambiado permisos por permiso

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Menu añadido');
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

function añadirSubMenuEnBaseDeDatos(id_Menu, posicion, nombreMenu) {

    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=añadirSubMenus&id_Menu=${id_Menu}&posicion=${posicion}&nombreMenu=${nombreMenu}`;
    // Cambiado permisos por permiso

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Menu añadido');
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


function editarNombre(id_Menu, nombre){
        mostrarPopup3();

        document.getElementById('nuevoNombre').value = nombre;
    
        document.getElementById('popup3').dataset.idMenu = id_Menu;
        document.getElementById('popup3').dataset.nombreActual = nombre;
}


function nuevoNombre() {
    // Obtener el nuevo valor del permiso desde el campo de entrada
    const nuevoNombre = document.getElementById('nuevoNombre').value;

    // Obtener el ID del menú y el permiso actual desde los atributos de datos del popup
    const id_Menu = document.getElementById('popup3').dataset.idMenu;
    const nombreActual = document.getElementById('popup3').dataset.nombreActual;

    // Verificar si el nuevo permiso es diferente al permiso actual
    if (nuevoNombre.trim() !== nombreActual) {
        // Llamar a la función para guardar el nuevo permiso
        guardarNombre(id_Menu, nombreActual, nuevoNombre);
    }

    // Cerrar el popup después de guardar el permiso
    cerrarPopup3();
}

function mostrarPopup3() {
    document.getElementById('popup3').style.display = 'block';
}

function cerrarPopup3() {
    document.getElementById('popup3').style.display = 'none';
}


function guardarNombre(id_Menu, nombreActual, nuevoNombre){

    let opciones = { method: "GET" };
    let parametros = `controlador=Seguridad&metodo=guardarNombre&id_Menu=${id_Menu}&nombreActual=${nombreActual}&nuevoNombre=${nuevoNombre}`;

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('Menu editado');
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