<?php
// Datos de los menús
$menus = $datos['menus'];

// Recorremos los menús
foreach ($menus as $menu) {
    // Si el menú tiene id_Padre igual a 0, lo mostramos como una tarjeta principal
    if ($menu['id_Padre'] == 0) {
?>
        <button>Añadir Opción</button>
        <div class="tarjeta">
            <h3><?php echo $menu['nombre']; ?></h3>
            <div class="permisos">
                <button type="button" id="botonPermisoMenu" onclick="añadirPermisoMenu(<?php echo $menu['id_Menu']; ?>)">Añadir permiso</button>
                <label for="b_permisoMenu"></label>
                <input type="text" id="b_permisoMenu" name="b_permisoMenu">
            </div>

            <!-- Buscar y mostrar submenús -->
            <?php foreach ($menus as $submenu) {
                if ($submenu['id_Padre'] == $menu['id_Menu']) { ?>
                    <div class="subtarjeta">
                        <p><?php echo $submenu['nombre']; ?></p>
                        <!-- Mostrar el contenido adicional de la subtarjeta si es necesario -->
                        <button class="boton_subpermiso" onclick="añadirPermisoSubmenu(<?php echo $submenu['id_Menu']; ?>)">Añadir permiso submenu</button>
                    </div>
            <?php }
            } ?>
        </div>
<?php
    }
}
?>