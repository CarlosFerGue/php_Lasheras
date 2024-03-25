//Valores usados en las funciones.
var tipoGuardado = "";
//Añadimos el evento de "comprobarUpdate()" al botón de guardar usuarios.
var botonGuardar = document.getElementById("boton");
botonGuardar.addEventListener("click", function() {
    comprobarGuardado(tipoGuardado);
});

//Parámetros que pasaremos al buscar usuarios.
var RangoResultados;
//BÚSQUEDAS, INSERCIONES Y MODIFICACIONES DE USUARIOS.
function buscarUsuarios(pagina_actual,rango_resultados){
    let opciones={method: "GET"};
    let parametros= "controlador=Usuarios&metodo=buscarUsuarios";
    //Controlamos los casos en que ambos parametros sean nulos.
    if(pagina_actual==null){pagina_actual=1}
    if(rango_resultados==null){
        if(RangoResultados==null){
            rango_resultados=10;
        } else {
            rango_resultados=RangoResultados
        }
    }
    //Guardamos los valores en la URL.
    parametros+="&" + new URLSearchParams(new FormData(document.getElementById("formularioBuscar"))).toString();
    parametros+="&pagina_actual="+pagina_actual;
    parametros+="&rango_resultados="+rango_resultados;
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Usuarios listados.');
                return res.text();
            }
        })
        .then(vista=>{
            document.getElementById("CapaResultadoBusqueda").innerHTML=vista;
        })
        .catch(err=>{
            console.log("Error al realizar la petición.", err.message);
        });
}
function guardarUsuario(){
    let opciones={method: "GET"};
    let parametros= "controlador=Usuarios&metodo=guardarUsuario";
    parametros+="&" + new URLSearchParams(new FormData(document.getElementById("editarUsuario"))).toString();
    console.log(parametros);

    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Usuario guardado.');
                return res.text();
                cerrarVentanas();
                buscarUsuarios();
            } else {
                mostrarError("Nombre de usuario ya existente.");
            }
        })
        .then(vista=>{
            cerrarVentanas();
            buscarUsuarios();
        })
        .catch(err=>{
            
        });
}
function aplicarRangoResultados(){
    let nuevoRango = document.getElementById("rangoResultados").value;
    console.log("nuevo rango:" + nuevoRango);
    RangoResultados = nuevoRango;
    buscarUsuarios(1,nuevoRango);
}

//FUNCIONES SOBRE LA VENTANA DE INSERCIÓN/ACTUALIZACIÓN DE DATOS
function mostrarAñadir(){
    blurBackground(1);
    cambiarVentana('editarUsuario', 1);
    document.getElementById("tituloEdt").innerHTML = "AÑADIR UN NUEVO USUARIO";
    document.getElementById("usuarioLabel").style.display = 'inline';
    document.getElementById("passwordLabel").style.display = 'inline';
    document.getElementById("usuarioBr").style.display = 'inline';
    document.getElementById("passwordBr").style.display = 'inline';
    document.getElementById("usuarioEdt").style.display = 'inline';
    document.getElementById("passwordEdt").style.display = 'inline';
    //Vaciamos todos los inputs.
    document.getElementById("idEdt").value = '';
    document.getElementById("usuarioEdt").value = '';
    document.getElementById("passwordEdt").value = '';
    document.getElementById("nombreEdt").value = '';
    document.getElementById("apellido1Edt").value = '';
    document.getElementById("apellido2Edt").value = '';
    document.getElementById("correoEdt").value = '';
    document.getElementById("usuarioEdt").value = '';
    document.getElementById("telefonoEdt").value = '';
    document.getElementById("masculinoEdt").checked = false;
    document.getElementById("femeninoEdt").checked = false;
    document.getElementById("activoEdt").checked = false;
    document.getElementById("inactivoEdt").checked = false;
    //Escondemos el botón de error
    var divError = document.getElementById("error");
    divError.style.display = "none";
    tipoGuardado = "INSERT";
}
function mostrarEditar(id,nombre,apellido_1,apellido_2,sexo,mail,movil,activo){
    console.log(id);
    blurBackground(1);
    cambiarVentana('editarUsuario', 1);
    document.getElementById("tituloEdt").innerHTML = "EDITAR USUARIO " + id;
    document.getElementById("idEdt").value = id;
    document.getElementById("usuarioLabel").style.display = 'none';
    document.getElementById("passwordLabel").style.display = 'none';
    document.getElementById("usuarioBr").style.display = 'none';
    document.getElementById("passwordBr").style.display = 'none';
    document.getElementById("usuarioEdt").style.display = 'none';
    document.getElementById("passwordEdt").style.display = 'none';
    document.getElementById("nombreEdt").value = nombre;
    document.getElementById("apellido1Edt").value = apellido_1;
    document.getElementById("apellido2Edt").value = apellido_2;
    //Marcamos el sexo que le corresponde al usuario que vamos a editar.
    if(sexo == "H"){
        document.getElementById("masculinoEdt").checked = true;
    }else if(sexo == "M"){
        document.getElementById("femeninoEdt").checked = true;
    }
    document.getElementById("correoEdt").value = mail;
    document.getElementById("telefonoEdt").value = movil;
    //Marcamos el sexo que le corresponde al usuario que vamos a editar.
    if(activo == "S"){
        document.getElementById("activoEdt").checked = true;
    }else if(activo == "N"){
        document.getElementById("inactivoEdt").checked = true;
    }
    //Escondemos el botón de error
    var divError = document.getElementById("error");
    divError.style.display = "none";
    tipoGuardado = "UPDATE";
}
function mostrarError(error){
    var divError = document.getElementById("error");
    divError.style.display = "block";
    divError.innerHTML = error;
}
function cerrarVentanas(){
    blurBackground(0);
    cambiarVentana('editarUsuario', 0);
}
function cambiarVentana(ventana, estado){
    var seleccionado = document.getElementById(ventana);
    if(estado == 0){
        seleccionado.style.display = 'none';
    }
    if(estado == 1){
        seleccionado.style.display = 'block';
    }
}
function blurBackground(accion){
    if (accion == 0){
        document.getElementById("formularioBuscar").style.filter = 'blur(0px)';
        document.getElementById("CapaResultadoBusqueda").style.filter = 'blur(0px)';
    }
    if (accion == 1){
        document.getElementById("formularioBuscar").style.filter = 'blur(5px)';
        document.getElementById("CapaResultadoBusqueda").style.filter = 'blur(5px)';
    }
}

//COMPROBACIONES DE DATOS
function comprobarGuardado(tipoGuardado){
    let comprobar = 1;
    var error = "";
    //Obtenemos los datos de todos los campos que usamos en el UPDATE
    const usuario = document.querySelector('#usuarioEdt').value;
    const password = document.querySelector('#passwordEdt').value;
    const nombre = document.querySelector('#nombreEdt').value;
    const apellido1 = document.querySelector('#apellido1Edt').value;
    const apellido2 = document.querySelector('#apellido2Edt').value;
    const correo = document.querySelector('#correoEdt').value;
    const telefono = document.querySelector('#telefonoEdt').value;
    //Obtenemsos el valor seleccionado en el "radio buttons" de GENERO y de ACTIVIDAD.
    var genero = "";
    const radiosGenero = document.getElementsByName('generoEdt');
    for (var i = 0; i < radiosGenero.length; i++) {
        if (radiosGenero[i].checked) {
            genero = radiosGenero[i].value;
            break;
        }
    }
    var actividad = "";
    const radiosActividad = document.getElementsByName('actividadEdt');
    for (var i = 0; i < radiosActividad.length; i++) {
        if (radiosActividad[i].checked) {
            actividad = radiosActividad[i].value;
            break;
        }
    }
    //Comprobamos que los campos no esten vacíos.
    if(tipoGuardado == "UPDATE"){
        if(nombre=="" || apellido1=="" || apellido2=="" || correo=="" || telefono=="" || genero=="" || actividad==""){
            comprobar = 0;
            error += "Por favor, rellene/seleccione todos los campos.\n"
        }
    } else if (tipoGuardado == "INSERT"){
        if(usuario=="" || password=="" || nombre=="" || apellido1=="" || apellido2=="" || correo=="" || telefono=="" || genero=="" || actividad==""){
            comprobar = 0;
            error += "Por favor, rellene/seleccione todos los campos.\n"
        }
    }
    //Comprobamos que el correo sea válido (damos como valido que contenga un "@" y un ".").
    const correo_valido = /.+@[^.]+\..+/.test(correo);
    if (correo_valido==false){
        comprobar = 0;
        error += "Introduzca un correo válido.\n";
    }
    //Mostramos errores o transicionamos a mostrar la info.
    if (comprobar==0){
        mostrarError(error);
    } else{
        guardarUsuario();
    }
}
