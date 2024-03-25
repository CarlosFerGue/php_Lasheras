<?php
    $resultados=$datos['resultados'][0];
    $id_Usuario=$datos['resultados'][1];
    $idRol=$datos['resultados'][2];
    if( count($resultados)>0 ){
        echo'<div class="rol-usuario" id="revocar-rol" onclick="asignacionRol('.$id_Usuario.','.$idRol.');">REVOCAR ROL</div>';
    } else {
        echo'<div class="rol-usuario" id="asignar-rol" onclick="asignacionRol('.$id_Usuario.','.$idRol.');">ASIGNAR ROL</div>';
    }

?>