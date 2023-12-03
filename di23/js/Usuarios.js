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


// function buscarUsuarios() {
//     let opciones = { method: "GET" };
//     // let parametros = "controlador=Usuarios&metodo=buscarUsuarios";
//     let parametros = "controlador=Usuarios&metodo=buscarUsuarios";
//     parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

//     fetch("C_Ajax.php?" + parametros, opciones)
//         .then(res => {
//             if (res.ok) {
//                 console.log('respuesta ok Usuarios');
//                 return res.text();
//             }
//         })
//         .then(vista => {
//             document.getElementById("CapaResultadoBusqueda").innerHTML = vista;
//         })
//         .catch(err => {
//             console.log("Error al realizar la petición", err.message);
//         });
// }



function buscarUsuarios(numeroPagina) {
    let opciones = { method: "GET" };

    let parametrosFormulario = new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

    let parametros = `controlador=Usuarios&metodo=buscarUsuarios&pagina=${numeroPagina}&${parametrosFormulario}`;

    console.log(parametros);

    fetch(`C_Ajax.php?${parametros}`, opciones)
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


function cambiarPagina(pagina) {
    console.log("La pagina es " + pagina);
    buscarUsuarios(pagina);
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

let sexoSeleccionado = '';


function insertarUsuario() {

    validarFormulario();

    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=insertarUsuario";
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioInsertar"))).toString();
    parametros += "&b_sexo=" + sexoSeleccionado; // Agrega el valor del sexo a los parámetros

    console.log(parametros)

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



function validarFormulario() {
    // Obtener los valores de los campos
    var nombre = document.getElementById("b_nombre").value;
    var apellido1 = document.getElementById("b_apellido1").value;
    var apellido2 = document.getElementById("b_apellido2").value;
    var email = document.getElementById("b_email").value;
    var movil = document.getElementById("b_movil").value;
    var usuario = document.getElementById("b_user").value;
    var password = document.getElementById("b_pass").value;

    // Validar que todos los campos estén completos
    if (!nombre || !apellido1 || !apellido2 || !email || !movil || !usuario || !password) {
        alert("Debe rellenar todos los campos");
        return;
    }

    // Validar el formato del email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("El formato del correo electrónico no es válido");
        return;
    }

    // Validar el formato del número de móvil
    var movilRegex = /^[0-9]{9}$/;
    if (!movilRegex.test(movil)) {
        alert("El número de móvil no es válido, ej: 666777333");
        return;
    }

    // Realizar cualquier otra validación que necesites

    // Si todas las validaciones son exitosas, puedes enviar el formulario
    alert("Usuario insertado correctamente");
    // Aquí puedes agregar código para enviar el formulario al servidor si es necesario

}


// function editarUsuario() {

//     let opciones = { method: "GET" };
//     let parametros = "controlador=Usuarios&metodo=editarUsuario";
//     parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioActualizar"))).toString();

//     console.log(parametros);

//     fetch("C_Ajax.php?" + parametros, opciones)
//         .then(res => {
//             if (res.ok) {
//                 console.log('respuesta ok Editar');
//                 return res.text();
//             }
//         })
//         .then(vista => {
//             document.getElementById("CapaResultadoBusqueda").innerHTML = vista;
//         })
//         .catch(err => {
//             console.log("Error al realizar la petición", err.message);
//         });

//         cerrarPopup();

// }

function editarUsuario() {
    let opciones = { method: "GET" };
    let parametros = "controlador=Usuarios&metodo=editarUsuario";
    parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioActualizar"))).toString();

    console.log(parametros);

    fetch("C_Ajax.php?" + parametros, opciones)
        .then(res => {
            if (res.ok) {
                console.log('respuesta ok Editar');
                return res.text();
            }
        })
        .then(vista => {
            document.getElementById("CapaResultadoBusqueda").innerHTML = vista;
        })
        .catch(err => {
            console.log("Error al realizar la petición", err.message);
        });

    cerrarPopup();
}


function cambiarSexo(sexo) {
    document.getElementById("b_sexo1").value = sexo;
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
    <form id="formularioActualizar" name="formularioActualizar" onkeydown="return event.key != 'Enter';">
        <div id="hide" style="display:none"><label for="b_id">ID Usuario: </label>
        <input  id="b_id" name="b_id" value="${idUsuario}"></div>

        <div class="idPop">
        <h2>El id: ${idUsuario}</h2>
        </div>

        <label for="b_nombre">Nombre del usuario:</label>
        <input type="text" id="b_nombre" name="b_nombre" value="${nombre}">
        
        <label for="b_apellido1">Apellido 1:</label>
        <input type="text" id="b_apellido1" name="b_apellido1" value="${apellido1}">
        
        <label for="b_apellido2">Apellido 2:</label>
        <input type="text" id="b_apellido2" name="b_apellido2" value="${apellido2}">
        
        <label for="b_sexo" style="display:none">Sexo:</label>
        <input type="text" id="b_sexo" name="b_sexo" value="">

        <label for="b_sexo">Sexo:</label>
        <div id="sexo" class="sexo">
            <button type="button" id="b_sexo1" name="b_sexo1" onclick="cambiarSexo('H')" ${sexo === 'H' ? 'disabled' : ''}>Hombre</button>
            <button type="button" id="b_sexo1" name="b_sexo1" onclick="cambiarSexo('M')" ${sexo === 'M' ? 'disabled' : ''}>Mujer</button>
        </div>

        <label for="b_email">Email:</label>
        <input type="text" id="b_email" name="b_email" value="${mail}">
        
        <label for="b_movil">Movil:</label>
        <input type="text" id="b_movil" name="b_movil" value="${movil}">

        
        <button type="button" onclick="editarUsuario()">Guardar cambios</button>
        <button type="button" onclick="cerrarPopup()">Cancelar</button>

        <div id="guardar">
        
        </div>

        </form>
    `;

    // Añadir el div emergente al body
    document.body.appendChild(popup);

    // Mostrar el div emergente
    popup.style.display = 'block';

}



function cerrarPopup() {
    // Eliminar el div emergente al hacer clic en el botón Cerrar
    var popup = document.getElementById('popup');
    if (popup) {
        document.body.removeChild(popup);
    }
}


buscar();

