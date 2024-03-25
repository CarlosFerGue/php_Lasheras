<?php
    $listadoOpciones=$datos['resultados'][0];
    $listado_permisos=$datos['resultados'][1];
    $permisos_asignados=$datos['resultados'][2];
    //Creamos el array de PADRES que contenga un subarray con los HIJOS en caso de que los tenga.
    $padres = array();
    foreach ($listadoOpciones as $fila) {
        if ($fila['idPadre'] == NULL) {
            // Si no tiene padre, se agrega directamente a $padres
            $padres[$fila['idMenu']] = $fila;
        }
        if ($fila['idPadre'] != NULL) {
            if (isset($padres[$fila['idPadre']])) {
                // Si el padre ya existe en $padres, se agregan los hijos al subarray 'hijos'
                $padres[$fila['idPadre']]['hijos'][] = $fila;
            } else {
                // Si el padre no existe en $padres, se crea una nueva entrada
                $padres[$fila['idPadre']] = array('hijos' => array($fila));
            }
        }
    }

    //Imprimimos en orden cada una de las opciones del menú.
    $ultimo_orden;
    foreach($padres as $padre){
        if(empty($padre['hijos'])){
            echo '<div class="form_nuevo">
                    <div class="add-subopcion" id="add-subopcion-'.($padre['idMenu']+".1").'" onclick="mostrarAñadir(0,'.($padre['orden']).',\'añadir-'.($padre['idMenu']+".1").'\');">Añadir Opción</div>
                    <div id="añadir-'.($padre['idMenu']+".1").'"></div>
                </div>';
            imprimirOpcion($padre,0,$listado_permisos,$permisos_asignados);
            $ultimo_orden=$padre['orden']+1;
            echo '<div class="contenedor-hijos">
                        <div class="form_nuevo" id="añadir-'.($padre['idMenu']).'">
                            <div class="add-subopcion" id="add-subopcion-'.($padre['idMenu']).'" onclick="mostrarAñadir('.($padre['idMenu']).','.($padre['orden']+1).',\'añadir-'.($padre['idMenu']).'\');">Añadir Subopción</div>
                        </div>
                   </div>
                </div>';
        } else {
            echo '<div class="form_nuevo">
                    <div class="add-subopcion" id="add-subopcion-'.($padre['idMenu']+".1").'" onclick="mostrarAñadir(0,'.($padre['orden']).',\'añadir-'.($padre['idMenu']+".1").'\');">Añadir Opción</div>
                    <div  id="añadir-'.($padre['idMenu']+".1").'"></div>
                </div>';
            imprimirOpcion($padre,1,$listado_permisos,$permisos_asignados);
            $ultimo_orden=$padre['orden']+1;
            echo '<div class="contenedor-hijos">
                <div class="form_nuevo">
                    <div class="add-subopcion" id="add-subopcion-'.($padre['idMenu']).'" onclick="mostrarAñadir('.($padre['idMenu']).','.($padre['orden']+1).',\'añadir-'.($padre['idMenu']).'\');">Añadir Subopción</div>
                    <div id="añadir-'.($padre['idMenu']).'"></div>    
                </div>';
            foreach($padre['hijos'] as $hijo){
                imprimirOpcion($hijo,0,$listado_permisos,$permisos_asignados);
                $ultimo_orden=$hijo['orden']+1;
                echo '</div>
                    <div class="form_nuevo">
                        <div class="add-subopcion" id="add-subopcion-'.($hijo['idMenu']).'" onclick="mostrarAñadir('.($padre['idMenu']).','.($hijo['orden']+1).',\'añadir-'.($hijo['idMenu']).'\');">Añadir Subopción</div>
                        <div id="añadir-'.($hijo['idMenu']).'"></div>    
                    </div>';
            }
            echo '</div></div>';
        }
    }
    echo '<script>añadirRolUsuario();</script>';
    //Imprimimos manualmente el último botón de añadir menú.
    echo '<div class="form_nuevo">
        <div class="add-subopcion" id="add-subopcion-ultimo" onclick="mostrarAñadir(0,'.$ultimo_orden.',\'añadir-ultimo\');">Añadir Opción</div>
        <div id="añadir-ultimo"></div>
    </div>';

    function imprimirOpcion($fila, $padre, $listado_permisos, $permisos_asignados){
        echo'
        <div class="contenedor-'.comprobarSubopcion($fila['idPadre']).'opcion" id="contenedor-opcion-'.$fila['idMenu'].'">
            <div class="formulario-opcion">
                <span class="titulo-opcion">'.$fila['titulo'].'</span>
                <form class="editar-opcion" id="datosMenu'.$fila['idMenu'].'" name="datosMenu'.$fila['idMenu'].'">
                    <select id="privado" name="privado">
                      <option value="0" '.comprobarPrivado(0,$fila['privado']).'>Público</option>
                      <option value="1" '.comprobarPrivado(1,$fila['privado']).'>Privado</option>
                    </select>
                    <label class="editar-accion" for="accion">Acción:
                        <input type="text" class="accion" id="accion" name="accion" placeholder="Introduzca una función JS..."
                        value=\''.htmlspecialchars($fila['accion']).'\'>
                    </label>
                </form>
                <img src="../imagenes/save.png" class="icono-opcion" onclick="actualizarMenu('.$fila['idMenu'].', \'datosMenu'.$fila['idMenu'].'\')">
                ';
                if($padre==0){
                    echo'<img src="../imagenes/delete.png" class="icono-opcion" onclick="borrarMenu('.$fila['idMenu'].')">';
                } else if ($padre==1){
                    echo'<img src="../imagenes/delete.png" class="icono-opcion-deshabilitado">';
                }

        echo'
            </div>
            <form class="lista-permisos-opcion" id="permisos-'.$fila['idMenu'].'">
            <div class="añadir-permiso" onclick="mostrarVentanaPermisos('.$fila['idMenu'].',0);">Añadir Permiso</div>
            <div class="contenedor-permisos">
        ';
        //Imprimimos los permisos correspondientes a cada menú.
        foreach($listado_permisos as $permiso){
            if($permiso['idMenu']==$fila['idMenu']){
                echo'
                <label id="label-permiso-'.$permiso['idPermiso'].'" class="label-permiso" for="permiso-'.$permiso['idPermiso'].'">
                    <input onclick="asignarPermiso('.$permiso['idPermiso'].');" type="checkbox" ';
                //En caso de que haya permisos asignados, realizamos la comprobación para dejar el permiso marcado o no.
                if($permisos_asignados!=0){
                    echo comprobarMarcado($permiso['idPermiso'], $permisos_asignados);
                }
                echo' id="permiso-'.$permiso['idPermiso'].'" name="permiso-'.$permiso['idPermiso'].'" value="'.$permiso['idPermiso'].'">
                    '.$permiso['permiso'].'
                </label>
                <img src="../imagenes/save.png" class="icono-permiso" onclick="mostrarVentanaPermisos('.$permiso['idMenu'].','.$permiso['idPermiso'].')">
                <img src="../imagenes/close.jpg" class="icono-permiso" onclick="eliminarPermiso('.$permiso['idPermiso'].')">
                ';
            }
        }
        echo'
            </div>
            </form>
        ';
    }

    function comprobarPrivado($valor, $privado){
        if($valor == $privado){
            return 'selected' ;
        }
    }

    function comprobarMarcado($idPermiso, $permisos_asignados){
        foreach ($permisos_asignados as $permiso) {
            if ($permiso['idPermiso'] == $idPermiso) {
                return 'checked'; // Devuelve 'checked' si se encuentra el idPermiso en el array de permisos asignados
            }
        }
        return '';
    }

    function comprobarSubopcion($idPadre){
        if($idPadre!=NULL){
            return 'sub';
        }
    }

?>