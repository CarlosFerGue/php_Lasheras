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
            <button>Añadir permiso</button>
            <!-- Mostrar el contenido adicional de la tarjeta si es necesario -->
            
            <!-- Buscar y mostrar submenús -->
            <?php foreach ($menus as $submenu) {
                if ($submenu['id_Padre'] == $menu['id_Menu']) { ?>
                    <div class="subtarjeta">
                        <p><?php echo $submenu['nombre']; ?></p>
                        <!-- Mostrar el contenido adicional de la subtarjeta si es necesario -->
                    </div>
            <?php }
            } ?>
        </div>
<?php
    }
}
?>
