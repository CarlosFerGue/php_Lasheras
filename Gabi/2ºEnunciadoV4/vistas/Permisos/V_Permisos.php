<div class="acordeon">
    <input type="checkbox" name="acordeon" id="btn-acordeon1" class="btn-acordeon" checked>
    <label for="btn-acordeon1" class="label_acordeon">
       Gestión de opciones del menú.
    </label>
    <!-- Formulario de gestión de PERMISOS -->
    <form id="form-permisos">
        <img src="../../imagenes/close.jpg" alt="CERRAR VENTANA" id="close_form" type="button" onclick="cerrarVentanas();">
        <h2><i>GUARDAR PERMISO</i></h2>
        <label id="label-idMenu" for="form_idMenu">ID Menu:
            <input type="text" id="form_idMenu" name="form_idMenu">
        </label>
        <label id="label-idPermiso" for="form_idPermiso">ID Permiso:
            <input type="text" id="form_idPermiso" name="form_idPermiso">
        </label>
        <label id="label-permiso" for="nombre_permiso">Nombre del permiso:
            <input type="text" id="nombre_permiso" name="nombre_permiso">
        </label>
        <button type="button" onclick="guardarPermiso();">GUARDAR PERMISO</button>
    </form>
    <!-- Formulario de gestión de ROLES -->
    <form id="form-roles">
        <img src="../../imagenes/close.jpg" alt="CERRAR VENTANA" id="close_form" type="button" onclick="cerrarVentanas();">
        <h2><i>GUARDAR ROL</i></h2>
        <label id="label-idRol" for="form_idRol">ID Permiso:
            <input type="text" id="form_idRol" name="form_idRol">
        </label>
        <label id="label-rol" for="nombre_rol">Nombre del rol:
            <input type="text" id="nombre_rol" name="nombre_rol">
        </label>
        <button type="button" onclick="guardarRol();">GUARDAR ROL</button>
    </form>
    <!-- HTML correspondiente a la gestión de opciones de menú -->
    <div class="contenido-acordeon">
        <form id="formularioMenu" name="formularioMenu">
            <label for="busquedasMenu" oninput="buscarMenus()">Buscar opciones menú:
                <input type="text" id="busquedas" name="busquedas" placeholder="opción menú...">
            </label>
            <label for="select_usuario">Usuario:
                <select onchange="buscarMenus()" class="select"  id="select_usuario" name="select_usuario">
                    <option id="select-usuario-0" value=0>Selecciona un usuario...</option>
                    <!-- Cargamos el listado de todos los usuarios. -->
                    <?php
                        $usuarios=$datos['resultados'][0];
                        foreach($usuarios as $usuario){
                            echo '<option id="select-usuario-'.$usuario['id_Usuario'].'" value="'.$usuario['id_Usuario'].'">'.$usuario['login'].'</option>';
                        }
                    ?>
                </select>
            </label>
            <label for="select_rol">Rol:
                <select onchange="buscarMenus()" class="select"  id="select_rol" name="select_rol">
                    <option id="select-rol-0" value=0>Selecciona un rol...</option>
                    <!-- Cargamos el listado de todos los usuarios. -->
                    <?php
                        $roles=$datos['resultados'][1];
                        foreach($roles as $rol){
                            echo '<option id="select-rol-'.$rol['idRol'].'" value="'.$rol['idRol'].'">'.$rol['rol'].'</option>';
                        }
                    ?>
                </select>
            </label>
            <img src="../imagenes/save.png" class="icono-form" onclick="mostrarVentanaRol()">
            <img src="../imagenes/close.jpg" class="icono-form" onclick="eliminarRol()">
            <div id="rol-usuario"></div>
        </form>
        <div id="ResultadosMenu";>
            <!-- <div class="add-subopcion" onclick="mostrarAñadirSubopción();">Añadir Subopción</div>
            <div class="contenedor-opcion">
                <div class="formulario-opcion">
                    <span class="titulo-opcion">CRUD's</span>
                    <form class="editar-opcion" id="datosMenu1" name="datosMenu1">
                        <select id="privado" name="privado">
                          <option value="0">Público</option>
                          <option value="1">Privado</option>
                        </select>
                        <label class="editar-accion" for="accion">Acción:
                            <input type="text" class="accion" id="accion" name="accion" placeholder="Introduzca una función JS...">
                        </label>
                    </form>
                    <img src="../imagenes/save.png" class="icono-opcion">
                    <img src="../imagenes/delete.png" class="icono-opcion">
                </div>
                <div class="contenedor-hijos">
                    <div class="add-subopcion" onclick="mostrarAñadir();">Añadir Subopción</div>
                    
                </div>
            </div> -->
        </div>
    </div>
</div>





<?php
    include("./vistas/Usuarios/V_Editar_Permisos.php");
?>