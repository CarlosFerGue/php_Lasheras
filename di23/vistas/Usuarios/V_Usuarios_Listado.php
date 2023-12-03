<?php


    $usuarios=$datos['usuarios'];

    echo '<table id=lista_usuarios>
            <tr>
              <th>NOMBRE</th>
              <th>APELLIDOS</th>
              <th>SEXO</th>
              <th>CORREO</th>
              <th>TELÉFONO</th>
              <th>ACTIVIDAD</th>
            </tr>';


    //Lo mismo que el whuile de ese gacho
    foreach($usuarios as $fila){

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
}


/////////////////////////////////////////////////////////////////////////////////////////

// Paginador
$numUsuarios = count($usuarios);
$usuariosPorPagina = 10; // Puedes ajustar la cantidad de usuarios por página según tus necesidades
$numPaginas = ceil($numUsuarios / $usuariosPorPagina);

// Obtener el número de página actual
$paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$inicio = ($paginaActual - 1) * $usuariosPorPagina;
$usuariosPagina = array_slice($usuarios, $inicio, $usuariosPorPagina);

// Imprimir el paginador
echo '<div id="paginador">';
echo '<span>Página ' . $paginaActual . ' de ' . $numPaginas . '</span>';
echo '<button onclick="cambiarPagina(1)">Primera</button>';
echo '<button onclick="cambiarPagina(' . max(1, $paginaActual - 1) . ')">Anterior</button>';

for ($i = max(1, $paginaActual - 2); $i <= min($numPaginas, $paginaActual + 2); $i++) {
    if ($i == $paginaActual) {
        echo '<button class="paginaActual">' . $i . '</button>';
    } else {
        echo '<button onclick="cambiarPagina(' . $i . ')">' . $i . '</button>';
    }
}

echo '<button onclick="cambiarPagina(' . min($numPaginas, $paginaActual + 1) . ')">Siguiente</button>';
echo '<button onclick="cambiarPagina(' . $numPaginas . ')">Última</button>';
echo '</div>';
?>

