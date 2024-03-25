<form id="formularioBuscar" name="formularioBuscar" onkeydown="return event.key != 'Enter';">
    <label for="busquedas" oninput="buscarUsuarios()">Nombre o apellidos:
        <input type="text" id="busquedas" name="busquedas" placeholder="Nombre o apellidos...">
    </label>
    <select id="genero" name="genero" onchange="buscarUsuarios()">
      <option value="">Marculino/Femenino</option>
      <option value="H">Masculino</option>
      <option value="M">Femenino</option>
    </select>
    <label for="telefono" oninput="buscarUsuarios()">Telefono:
        <input type="text" id="telefono" name="telefono" placeholder="Número de telefono...">
    </label>
    <div class="selectorActividad" for="actividad"><b>Actividad:</b>
        <div class="selection" onclick="buscarUsuarios()">
            <input type="radio" id="checkActivo" value="S" name="actividad">
            <label for="checkActivo">Activo</label>
        </div>
        <div class="selection" onclick="buscarUsuarios()">
            <input type="radio" id="checkInactivo" value="N" name="actividad">
            <label for="checkInactivo">Inactivo</label>
        </div>
        <div class="selection" onclick="buscarUsuarios()">
            <input type="radio" checked id="checkAmbos" value="" name="actividad">
            <label for="checkAmbos">Ambos</label>
        </div>
    </div>
    <!-- Comprobamos si el usuario cuenta con permisos para añadir usuarios. -->
    <?php
        $id_permiso = 7;
        $tiene_permiso = 0;
        foreach ($_SESSION['permisos'] as $permiso){
            if ($permiso['idPermiso'] == $id_permiso){
                $tiene_permiso = 1;
            }
        }
        if($tiene_permiso == 1){
            echo '<button id="abrirAñadir" type="button" onclick="mostrarAñadir();">AÑADIR USUARIO</button>';
        }
    ?>
</form>
<div id="CapaResultadoBusqueda">

</div>

<?php
    include("./vistas/Usuarios/V_Editar.php");
?>