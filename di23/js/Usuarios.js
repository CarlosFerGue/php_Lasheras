let numeroPagina = 0;

function buscar(numeroPagina) {
    const input1 = document.getElementById("b_texto").value;
    const input2 = document.getElementById("b_telefono").value;
    console.log(input1);
    console.log(input2);
    if (input1 && !input2) {
        // Caso 1: Solo input1 tiene texto
        buscarUsuarios(numeroPagina);
        console.log("Solo input1 tiene texto.");
    } else if (!input1 && input2) {
        buscarTelefono(numeroPagina);
        // Caso 2: Solo input2 tiene texto
        console.log("Solo input2 tiene texto.");
    } else if (input1 && input2) {
        // Caso 3: Ambos inputs tienen texto
        buscarTelefonoyUsuario(numeroPagina);
        console.log("Ambos inputs tienen texto.");
    } else {
        buscarUsuarios(numeroPagina);
        // Caso 4: Ningún input tiene texto
        console.log("Ninguno de los inputs tiene texto.");
    }
}



// function buscarTelefonoyUsuario(numeroPagina) {
//     let opciones = { method: "GET" };
//     let parametros = "controlador=Usuarios&metodo=buscarTelefonoyUsuario";
//     parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscarTelefono"))).toString();
//     parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

//     fetch("C_Ajax.php?" + parametros, opciones)
//         .then(res => {
//             if (res.ok) {
//                 console.log('respuesta ok Telefono y Usuario');
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

function buscarTelefonoyUsuario(numeroPagina) {
    let opciones = { method: "GET" };
    let parametrosFormularioTelefono = new URLSearchParams(new FormData(document.getElementById("formularioBuscarTelefono"))).toString();
    let parametrosFormularioUsuario = new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

    if (numeroPagina == null) {
        numeroPagina = 0;
    }

    let parametros = `controlador=Usuarios&metodo=buscarTelefonoyUsuario&pagina=${numeroPagina}&${parametrosFormularioTelefono}&${parametrosFormularioUsuario}`;

    console.log(parametros);

    fetch(`C_Ajax.php?${parametros}`, opciones)
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


function buscarUsuarios(numeroPagina) {
    let opciones = { method: "GET" };

    let parametrosFormulario = new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();

    if (numeroPagina == null) {
        numeroPagina = 0;
    }

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
    buscar(pagina);
}


// function buscarTelefono(numeroPagina) {
//     let opciones = { method: "GET" };
//     let parametros = "controlador=Usuarios&metodo=buscarTelefono";
//     parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscarTelefono"))).toString();

//     fetch("C_Ajax.php?" + parametros, opciones)
//         .then(res => {
//             if (res.ok) {
//                 console.log('respuesta ok Telefono');
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

function buscarTelefono(numeroPagina) {
    let opciones = { method: "GET" };
    let parametrosFormularioTelefono = new URLSearchParams(new FormData(document.getElementById("formularioBuscarTelefono"))).toString();


    if (numeroPagina == null) {
        numeroPagina = 0;
    }


    let parametros = `controlador=Usuarios&metodo=buscarTelefono&pagina=${numeroPagina}&${parametrosFormularioTelefono}`;

    console.log(numeroPagina);

    fetch(`C_Ajax.php?${parametros}`, opciones)
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


// function insertarUsuario() {

//     if (validarFormulario() != 1) {

//     } else {


//         let opciones = { method: "GET" };
//         let parametros = "controlador=Usuarios&metodo=insertarUsuario";
//         parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioInsertar"))).toString();
     

//         console.log(parametros)

//         fetch("C_Ajax.php?" + parametros, opciones)
//             .then(res => {
//                 if (res.ok) {
//                     console.log('respuesta ok Insertar');
//                     return res.text();
//                 }
//             })
//             .then(vista => {
//                 document.getElementById("CapaResultadoBusqueda").innerHTML = vista;
//             })
//             .catch(err => {
//                 console.log("Error al realizar la petición", err.message);
//             });
//     }
// }

function insertarUsuario() {
    if (validarFormulario() != 1) {
        // Haz algo si el formulario no es válido
    } else {
        let opciones = { method: "GET" };
        let parametros = "controlador=Usuarios&metodo=insertarUsuario";

        // Agregar los parámetros del formulario
        parametros += "&" + new URLSearchParams(new FormData(document.getElementById("formularioInsertar"))).toString();

        // Obtener el valor del sexo seleccionado
        let sexoButton = document.querySelector('input[name="b_sexo"]:checked');
        
        // Verificar si se seleccionó un botón de opción antes de obtener el valor
        let sexo = sexoButton ? sexoButton.value : '';
        
        // Agregar el valor del sexo a los parámetros
        parametros += "&b_sexo=" + sexo;

        console.log(parametros);

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
}




function validarFormulario() {

    let nombre = document.getElementById("b_nombre").value;
    let apellido1 = document.getElementById("b_apellido1").value;
    let apellido2 = document.getElementById("b_apellido2").value;
    let email = document.getElementById("b_email").value;
    let movil = document.getElementById("b_movil").value;
    let usuario = document.getElementById("b_user").value;
    let password = document.getElementById("b_pass").value;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let movilRegex = /^[0-9]{9}$/;


    if (!nombre || !apellido1 || !apellido2 || !email || !movil || !usuario || !password) {
        alert("Debe rellenar todos los campos");
    } else if (!emailRegex.test(email)) {
        alert("El formato del correo electrónico no es válido");
    } if (!movilRegex.test(movil)) {
        alert("El número de móvil no es válido, ej: 666777333");

    } else {
        return 1;
    }
}


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


function cambiarSexoEditar(sexo) {

    let labelSexo1 = document.getElementById("b_sexo1");
    let divSexo = document.getElementById("sexo");
    labelSexo1.parentNode.removeChild(labelSexo1);
    divSexo.parentNode.removeChild(divSexo);


    let nuevoContenido = `
         <div style = "display:none">
         <label for="b_sexo" style="display:none">Sexo:</label>
         <input type="text" id="b_sexo" name="b_sexo" value="${sexo}"></div>
     `;
    document.getElementById("hide").insertAdjacentHTML('afterend', nuevoContenido);

    console.log(sexo);
}


function mostrarEditar(idUsuario, nombre, apellido1, apellido2, sexo, mail, movil, activo) {
    let popupExistente = document.getElementById('popup');

    if (popupExistente) {
        popupExistente.remove();
    }

    let popup = document.createElement('div');
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

        <label for="b_sexo1" id="b_sexo1">Sexo:</label>
        <div id="sexo" class="sexo">
            <button type="button" id="b_sexo1" name="b_sexo1" onclick="cambiarSexoEditar('H')" ${sexo === 'H' ? 'disabled' : ''}>Hombre</button>
            <button type="button" id="b_sexo1" name="b_sexo1" onclick="cambiarSexoEditar('M')" ${sexo === 'M' ? 'disabled' : ''}>Mujer</button>
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

    document.body.appendChild(popup);

    popup.style.display = 'block';

}



function cerrarPopup() {
    let popup = document.getElementById('popup');
    if (popup) {
        document.body.removeChild(popup);
    }
}

buscar(numeroPagina);

