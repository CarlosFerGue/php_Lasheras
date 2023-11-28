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
        buscarTelefonoyUsuario();
        console.log("Ambos inputs tienen texto.");
    } else {
        buscarUsuarios();
        // Caso 4: Ningún input tiene texto
        console.log("Ninguno de los inputs tiene texto.");
    }
}


function buscarTelefonoyUsuario() {
    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=buscarTelefonoyUsuario";
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscarTelefono"))).toString();
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok Telefono y Usuario');
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

function insertarUsuario() {
    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=insertarUsuario";
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioInsertar"))).toString();

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok Insertar');
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

function cambiarSexo(sexo) {
    document.getElementById("b_sexo").value = sexo;
    console.log(sexo);
}


function mostrarEditar(idUsuario, nombre, apellido1, apellido2, sexo, mail, movil, activo) {
    // Verificar si el div popup ya existe
    var popupExistente = document.getElementById('popup');

    // Si existe, eliminarlo antes de crear uno nuevo
    if (popupExistente) {
        popupExistente.remove();
    }

    // Crear el div emergente
    var popup = document.createElement('div');
    popup.id = 'popup';
    popup.innerHTML = `
            <h2>ID Usuario: ${idUsuario}</h2>
            <p>Nombre: ${nombre}</p>
            <p>Apellido 1: ${apellido1}</p>
            <p>Apellido 2: ${apellido2}</p>
            <p>Sexo: ${sexo}</p>
            <p>Email: ${mail}</p>
            <p>Móvil: ${movil}</p>
            <p>Activo: ${activo}</p>
            <button onclick="cerrarPopup()">Cerrar</button>
        `;

    // Añadir el div emergente al body
    document.body.appendChild(popup);

    // Mostrar el div emergente
    popup.style.display = 'block';

    // Agregar un listener para clics en el documento
    document.addEventListener("click", cerrarPopupSiClicasFuera);
}



function cerrarPopup() {
    // Eliminar el div emergente al hacer clic en el botón Cerrar
    var popup = document.getElementById('popup');
    if (popup) {
        document.body.removeChild(popup);
    }
}