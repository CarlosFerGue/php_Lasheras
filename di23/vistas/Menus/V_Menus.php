<?php

    $menus = $datos['menus'];


    foreach ($menus as $fila) {
        echo '<tr class="filaTr">';
        echo '<td>' . $fila['id_Menu'] . '</td>';
        echo '<td>' . $fila['nombre'] . '</td>';
        echo '<td>' . $fila['id_Padre'] . '</td>';
        echo '<td>' . $fila['accion'] . '</td>';
        echo '<td>' . returnActivo($fila) . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';

    function returnPrivado($fila){
        if () {
            
        }elseif(){

        }

    }
?>