<?php

    $menus = $datos['menus'];


    foreach ($menus as $fila) {
        echo '<tr class="filaTr">';
        echo '<td>' . $fila['nombre'] . '</td>';
        echo '<td>' . $fila['accion'] . '</td>';
        echo '<td>' . returnPrivado($fila) . '</td>';
        echo '</tr>';
        echo '<tr><td colspan="5"><br></td></tr>';  // Agregar un salto de línea en la fila siguiente

    }
    
    echo '</table>';

    function returnPrivado($fila){
        if ($fila['privado'] == 'N') {
            return "Publico";
        }elseif($fila['privado'] == 'S'){
            return "Privado";
        }

    }
?>