<?php
    $usuarios=$datos['usuarios'];

    foreach($usuarios as $fila){
<<<<<<< HEAD
        echo '<tr class="filaTr">';
        echo '<td>'.$fila['nombre'].'</td>';
        echo '<td>'.$fila['apellido_1'].' '.$fila['apellido_2'].'</td>';
        echo '<td>'.returnGenero($fila).'</td>';
        echo '<td>'.$fila['mail'].'</td>';
        echo '<td>'.$fila['movil'].'</td>';
        echo '<td>'.returnActivo($fila).'</td>';
        echo '<td class="editTd"><img src="imagenes/editar.png" type="button" ';
        echo 'onclick="mostrarEditar(' . $fila['id_Usuario'] . ', \'' . $fila['nombre'] . '\', \'' . $fila['apellido_1'] . '\', \'' . $fila['apellido_2'] . '\', \'' . $fila['sexo'] . '\', \'' . $fila['mail'] . '\', \'' . $fila['movil'] . '\', \'' . $fila['activo'] . '\');" ';
            echo 'class="editBtn"></td>';
        echo '</tr>';
    }
    echo '</table>';

    function returnGenero($fila) {
        if ($fila['sexo'] == 'H') {
            return "Masculino" ;
        } elseif ($fila['sexo'] == 'M') {
            return "Femenino";
        }
    }


    function returnActivo($fila){
        if($fila['activo'] == 'S'){
            return "Activo";
        }elseif($fila['activo'] == 'N'){
            return"Inactivo";
        }
=======
        echo $fila['apellido_1'].' '.$fila['apellido_2'].', '.$fila['nombre'].'<br>';
>>>>>>> parent of d90af24 (Tablatura)
    }
?>