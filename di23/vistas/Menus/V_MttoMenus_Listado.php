<?php
// Datos de los menús
$menus = $datos['menus'];
$permisos = $datos['permisos'];

// Recorremos los menús
foreach ($menus as $menu) {
    // Si el menú tiene id_Padre igual a 0, lo mostramos como una tarjeta principal
    if ($menu['id_Padre'] == 0) {
?>
        <!-- <button type="button" onclick="añadirMenu(<?php echo $menu['id_Menu']; ?>, '<?php echo $menu['posicion']; ?>')">Añadir Menu</button> -->
        <button type="button" onclick="mostrarPopupAñadirMenu()">Añadir Menú</button>
        <div class="tarjeta">
            <h3><?php echo $menu['nombre']; ?></h3>
            <div class="permisos">
                <button type="button" id="botonPermisoMenu" onclick="añadirPermisoMenu(<?php echo $menu['id_Menu']; ?>, '<?php echo $menu['nombre']; ?>')">Añadir permiso</button>
                <label for="b_permisoMenu"></label>
                <input type="text" id="<?php echo $menu['nombre']; ?>" name="b_permisoMenu">

                <!-- Verificar si hay permisos asociados a este menú -->
                <?php foreach ($permisos as $permiso) {
                    if ($permiso['id_Menu'] == $menu['id_Menu']) { ?>
                        <div id="<?php echo $menu['nombre']; ?>/<?php echo $permiso['permiso']; ?>">
                            <p><?php echo $permiso['permiso']; ?></p>
                            <!-- Botón para borrar permiso -->
                            <button type="button" onclick="borrarPermiso('<?php echo $menu['id_Menu']; ?>', '<?php echo $permiso['permiso']; ?>')">X</button>
                            <button type="button" onclick="editarPermiso('<?php echo $menu['id_Menu']; ?>', '<?php echo $permiso['permiso']; ?>')">E</button>
                        </div>


                <?php }
                } ?>



            </div>

            <div class="eliminarMenu">
                <button type="button" id="botonPermisoMenu" onclick="eliminarMenu(<?php echo $menu['id_Menu']; ?>)">Borrar menu</button>
            </div>

            <!-- Buscar y mostrar submenús -->
            <?php foreach ($menus as $submenu) {
                if ($submenu['id_Padre'] == $menu['id_Menu']) { ?>
                    <!-- <button type="button" onclick="añadirMenu(<?php echo $submenu['id_Menu']; ?>, '<?php echo $submenu['posicion']; ?>')">Añadir Submenu</button> -->
                    <button type="button" onclick="mostrarPopupAñadirMenu()">Añadir Submenu</button>
                    <div class="subtarjeta">
                        <!-- Mostrar nombre del submenú -->
                        <h5><?php echo $submenu['nombre']; ?></h5>
                        <div class="permisos">
                            <button type="button" id="botonPermisoMenu" onclick="añadirPermisoSubMenu(<?php echo $submenu['id_Menu']; ?>, '<?php echo $submenu['nombre']; ?>')">Añadir permiso</button>
                            <label for="b_permisoMenu"></label>
                            <input type="text" id="<?php echo $submenu['nombre']; ?>" name="b_permisoMenu">

                            <!-- Verificar si hay permisos asociados a este submenú -->
                            <?php foreach ($permisos as $permiso) {
                                if ($permiso['id_Menu'] == $submenu['id_Menu']) { ?>
                                    <div id="<?php echo $submenu['nombre']; ?>/<?php echo $permiso['permiso']; ?>">
                                        <p><?php echo $permiso['permiso']; ?></p>
                                        <!-- Botón para borrar permiso -->
                                        <button type="button" onclick="borrarPermiso('<?php echo $submenu['id_Menu']; ?>', '<?php echo $permiso['permiso']; ?>')">X</button>
                                        <button type="button" onclick="editarPermiso('<?php echo $submenu['id_Menu']; ?>', '<?php echo $permiso['permiso']; ?>')">E</button>


                                    </div>

                            <?php }
                            } ?>

                        </div>

                        <div class="eliminarMenu">
                            <!-- <button type="button" id="botonPermisoMenu" onclick="eliminarMenu(<?php echo $submenu['id_Menu']; ?>)">Borrar submenu</button> -->
                            <button type="button" onclick="mostrarPopupAñadirMenu()">Añadir Submenu</button>
                        </div>

                    </div>

            <?php }
            } ?>
            <!-- <button type="button" onclick="añadirMenu(<?php echo $submenu['id_Menu']; ?>, '<?php echo $menu['posicion']; ?>')">Añadir Submenu</button> -->
            <button type="button" onclick="mostrarPopupAñadirMenu()">Añadir Submenu</button>
        </div>

<?php
    }
}
?>
<!-- <button type="button" onclick="añadirMenu(<?php echo $menu['id_Menu']; ?>, '<?php echo $menu['posicion']; ?>')">Añadir Menu</button> -->
<button type="button" onclick="mostrarPopupAñadirMenu()">Añadir Submenu</button>


<!-- Ventanita donde editas los permisos que de normal esta oculta -->
<div id="popup2" class="popup">
    <div class="popup-content">
        <span class="close" onclick="cerrarPopup()">&times;</span>
        <h2>Editar Permiso</h2>
        <input type="text" id="nuevoPermiso" placeholder="Nuevo valor del permiso">
        <button onclick="guardarNuevoPermiso()">Guardar</button>
        <button onclick="cerrarPopup()">Cancelar</button>
    </div>
</div>

<!-- Ventana donde añades menus -->
<div id="popupAñadirMenu" class="popup">
    <div class="popup-content">
        <span class="close" onclick="cerrarPopup('popupAñadirMenu')">&times;</span>
        <h2>Añadir Menú</h2>
        <input type="text" id="nombreMenu" placeholder="Nombre del menú">
        <button onclick="guardarNuevoMenu()">Guardar</button>
        <button onclick="cerrarPopup('popupAñadirMenu')">Cancelar</button>
    </div>
</div>