function buscarMenus(){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=buscarMenus";
    
    //Guardamos los valores en la URL.
    parametros+="&" + new URLSearchParams(new FormData(document.getElementById("formularioMenu"))).toString();

    var usuario = document.getElementById("select_usuario");
    var rol = document.getElementById("select_rol");
    parametros+="&id_Usuario="+usuario.value+"&idRol="+rol.value;

    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Menús listados.');
                return res.text();
            }
        })
        .then(vista=>{
            document.getElementById("ResultadosMenu").innerHTML=vista;
            //Obtenemos los elementos HTML a modificar.
            var usuario=document.getElementById("select_usuario");
            var rol=document.getElementById("select_rol");
            console.log('Usuario:'+usuario.value+' - Rol:'+rol.value);
            //Si se ha seleccinoado un rol o un usuario, bloquearemos los campos de edición y borrado de menús.
            if(usuario.value!=0 || rol.value!=0){
                var adds = document.querySelectorAll('.add-subopcion');
                adds.forEach(function(add) {
                    add.style.display = 'none';
                });
                var editores = document.querySelectorAll('.editar-opcion');
                editores.forEach(function(editor) {
                    editor.style.display = 'none';
                });
                var iconos = document.querySelectorAll('.icono-opcion');
                iconos.forEach(function(icono) {
                    icono.style.display = 'none';
                });
                var iconos_deshabilitados = document.querySelectorAll('.icono-opcion-deshabilitado');
                iconos_deshabilitados.forEach(function(icono_deshabilitado) {
                    icono_deshabilitado.style.display = 'none';
                });
                var rol_usuario = document.getElementById('rol-usuario');
                rol_usuario.innerHTML = "";
            }
            //En caso de que ambos estén seleccionados, escondemos los campos de permisos y mostramos el botón de asignación de roles.
            if(usuario.value!=0 && rol.value!=0){
                imprimirRolUsuario(usuario.value, rol.value);
                var permisos = document.querySelectorAll('.lista-permisos-opcion');
                permisos.forEach(function(permiso) {
                    permiso.style.display = 'none';
                });
            }
             
        })
        .catch(err=>{
            console.log("Error al realizar la petición.", err.message);
        });
}

function actualizarMenu(id, formulario){
    let opciones={method: "GET"};
    console.log(formulario);
    let parametros= "controlador=Permisos&metodo=actualizarMenu";
    //Añadimos el id del usuario a los parametros.
    parametros+="&id="+id;
    //Obtenemos los datos del formulario usando la .
    var form = formulario;
    parametros+="&" + new URLSearchParams(new FormData(document.getElementById(form))).toString();
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Menú actualizado.');
                return res.text();
            }
        })
        .catch(err=>{
            console.log("Error al actualizar la información: ", err.message);
        });
}

function borrarMenu(id){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=borrarMenu";
    //Añadimos el id del usuario a los parametros.
    parametros+="&id="+id;
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Opción de menú borrado.');
                return res.text();
            }
        })
        .then(vista=>{
            //var div = document.getElementById("contenedor-opcion-"+id);
            //var add1 = document.getElementById("add-subopcion-"+id);
            //var add1_1 = document.getElementById("add-subopcion-"+id+".1");
            //div.style.display = "none";
            //add1.style.display = "none";
            //add1_1.style.display = "none";
            buscarMenus();
        })
        .catch(err=>{
            console.log("Error al tratar de realizar el borrado: ", err.message);
        });
}

function eliminarPermiso(id){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=eliminarPermiso";
    //Añadimos el id del usuario a los parametros.
    parametros+="&idPermiso="+id;
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Permiso borrado.');
                return res.text();
            }
        })
        .then(vista=>{
            //var labels = document.querySelectorAll("#label-permiso-"+id);
            //labels.forEach(function(label) {
            //        label.style.display = 'none';
            //    });
            buscarMenus();
        })
        .catch(err=>{
            console.log("Error al tratar de realizar el borrado: ", err.message);
        });
}

function asignarPermiso(idPermiso){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=asignarPermiso";
    //Añadimos el id del permiso y el ID de usuario a los parametros.
    var usuario = document.getElementById("select_usuario");
    var rol = document.getElementById("select_rol");
    parametros+="&idPermiso="+idPermiso+"&id_Usuario="+usuario.value+"&idRol="+rol.value;
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Permiso asignado/revocado.');
                return res.text();
            }
        })
        .catch(err=>{
            console.log("Error al asignar/quitar el permiso: ", err.message);
        });
}

function añadirMenu(idPadre, orden, div_name){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=anadirMenu";
    //Guardamos los valores en la URL.
    parametros+="&" + new URLSearchParams(new FormData(document.getElementById(div_name))).toString();
    //Añadimos el id del padre y el orden a los parametros.
    parametros+="&idPadre="+idPadre+"&orden="+orden;
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Menú añadido y permisos creados.');
                return res.text();
            }
        })
        .then(vista=>{
            buscarMenus();
        })
        .catch(err=>{
            console.log("Error al realizar la petición.", err.message);
        });

}

function mostrarAñadir(idPadre, orden, div_name){
    var div = document.getElementById(div_name);
    div.innerHTML = '<form id="form-'+div_name+'" class="form-añadir">' +
        '<label for="titulo">Título:</label>' +
            '<input type="text" style="width: 200px;" class="form-new-input" id="titulo" name="titulo">' +
        '<select id="privado" name="privado" required>' +
            '<option value="1">Privado</option>' +
            '<option value="0">Público</option>' +
        '</select>' +
        '<label for="accion">Acción:</label>' +
            '<input type="text" class="form-new-input" id="accion" name="accion">' +
        '<div class="btn_añadir_menu" onclick="añadirMenu('+idPadre+','+orden+',\'form-'+div_name+'\')">AÑADIR</div>' +
    '</form>';
}

function asignacionRol(id_Usuario, idRol){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=asignacionRol";
    //Añadimos el id del padre y el orden a los parametros.
    parametros+="&id_Usuario="+id_Usuario+"&idRol="+idRol;
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Se ha asignado/revocado el rol.');
                return res.text();
            }
        })
        .then(vista=>{
            buscarMenus();
        })
        .catch(err=>{
            console.log("Error al realizar la petición.", err.message);
        });
}

function imprimirRolUsuario(id_Usuario, idRol){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=comprobarRolUsuario";
    //Añadimos el id del padre y el orden a los parametros.
    parametros+="&id_Usuario="+id_Usuario+"&idRol="+idRol;
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Botón de asignar/revocar rol añadido.');
                return res.text();
            }
        })
        .then(vista=>{
            document.getElementById("rol-usuario").innerHTML=vista;
        })
        .catch(err=>{
            console.log("Error al realizar la petición.", err.message);
        });
}

function cerrarVentanas(){
    var form_permisos = document.getElementById("form-permisos");
    form_permisos.style.display = 'none';
    var form_rol = document.getElementById("form-roles");
    form_rol.style.display = 'none';
}

function mostrarVentanaPermisos(idMenu, permiso){
    var form_permisos = document.getElementById("form-permisos");
    form_permisos.style.display = 'flex';
    var form_idMenu = document.getElementById("form_idMenu");
    form_idMenu.value = idMenu;
    var form_idPermiso = document.getElementById("form_idPermiso");
    form_idPermiso.value = permiso;
}

function mostrarVentanaRol(){
    //Mostramos la ventana.
    var form_permisos = document.getElementById("form-roles");
    form_permisos.style.display = 'flex';
    //Obtenemos el ID del rol seleccionado y se lo asignamos al input.
    var rol = document.getElementById("select_rol");
    var form_idRol = document.getElementById("form_idRol");
    form_idRol.value = rol.value;
    //Autocompletamos el texto del input de nombre en caso de que hayamos seleccionado un rol.
    if(rol.value==0){
        var nombre_rol = document.getElementById("nombre_rol");
        nombre_rol.value = "";
    }
    if(rol.value!=0){
        var selectedIndex = rol.selectedIndex;
        var selectedOptionText = rol.options[selectedIndex].textContent;
        var nombre_rol = document.getElementById("nombre_rol");
        nombre_rol.value = selectedOptionText;
    }
}

function guardarPermiso(){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=guardarPermiso";
    //Añadimos el id del padre y el orden a los parametros.
    parametros+="&" + new URLSearchParams(new FormData(document.getElementById("form-permisos"))).toString();
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Permiso cuardado.');
                return res.text();
            }
        })
        .then(vista=>{
            buscarMenus();
            cerrarVentanas();
        })
        .catch(err=>{
            console.log("Error al realizar la petición.", err.message);
        });
}

function guardarRol(){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=guardarRol";
    //Añadimos el id del padre y el orden a los parametros.
    parametros+="&" + new URLSearchParams(new FormData(document.getElementById("form-roles"))).toString();
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Rol cuardado.');
                return res.text();
            }
        })
        .then(vista=>{
            buscarMenus();
            cerrarVentanas();
        })
        .catch(err=>{
            console.log("Error al realizar la petición.", err.message);
        });
}

function eliminarRol(){
    let opciones={method: "GET"};
    let parametros= "controlador=Permisos&metodo=eliminarRol";
    //Añadimos el id del padre y el orden a los parametros.
    var rol = document.getElementById("select_rol");
    parametros+="&idRol="+rol.value;
    console.log(parametros);
    fetch("C_Ajax.php?"+parametros, opciones)
        .then(res => {
            if(res.ok){
                console.log('Rol eliminado.');
                return res.text();
            }
        })
        .then(vista=>{
            buscarMenus();
            cerrarVentanas();
        })
        .catch(err=>{
            console.log("Error al realizar la petición.", err.message);
        });
}