<?php

$usuarios = $datos['usuarios'];

// Obtener la cantidad de usuarios por pagina desde el formulario o por defecto
$usuariosPorPagina = 10;

// Paginador
$numUsuarios = count($usuarios);
$numPaginas = ceil($numUsuarios / $usuariosPorPagina);

// Obetnecion del numero de pagina actual
$paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$inicio = ($paginaActual - 1) * $usuariosPorPagina;
$usuariosPagina = array_slice($usuarios, $inicio, $usuariosPorPagina);


//Modificar cuantos usuarios salen por cada apgina
echo '<form method="get" action="" id="usuariosPorPaginaForm" name="usuariosPorPaginaForm">';
echo '<label for="usuariosPorPagina">Usuarios por página:</label>';
echo '<select name="usuariosPorPagina" id="usuariosPorPagina" onchange="buscar('. $paginaActual .')">';
echo '<option value="5" ' . ($usuariosPorPagina == 5 ? 'selected' : '') . '>5</option>';
echo '<option value="10" ' . ($usuariosPorPagina == 10 ? 'selected' : '') . '>10</option>';
echo '<option value="20" ' . ($usuariosPorPagina == 20 ? 'selected' : '') . '>20</option>';
echo '</select>';
echo '</form>';



//La parte de arriba de la tabla
echo '<table id=lista_usuarios>
        <tr>
          <th>NOMBRE</th>
          <th>APELLIDOS</th>
          <th>SEXO</th>
          <th>CORREO</th>
          <th>TELÉFONO</th>
          <th>ACTIVIDAD</th>
        </tr>';



    // Impresion linea por linea de los usuarios
    foreach ($usuariosPagina as $fila) {
        echo '<tr class="filaTr">';
        echo '<td>' . $fila['nombre'] . '</td>';
        echo '<td>' . $fila['apellido_1'] . ' ' . $fila['apellido_2'] . '</td>';
        echo '<td>' . returnGenero($fila) . '</td>';
        echo '<td>' . $fila['mail'] . '</td>';
        echo '<td>' . $fila['movil'] . '</td>';
        echo '<td>' . returnActivo($fila) . '</td>';

        // Obtiene el rol y los permisos de las sesiones
        $rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
        $permisos = isset($_SESSION['permisos']) ? $_SESSION['permisos'] : array();

        //Depende el rol y permisos que tenga podra editar o no usuarios
        foreach ($permisos as $permiso) {
            if ($rol == 1 || $rol == 2 || $permiso == 2) {
                echo '<td class="editTd"><img src="imagenes/editar.png" type="button" ';
                echo 'onclick="mostrarEditar(' . $fila['id_Usuario'] . ', \'' . $fila['nombre'] . '\', \'' . $fila['apellido_1'] . '\', \'' . $fila['apellido_2'] . '\', \'' . $fila['sexo'] . '\', \'' . $fila['mail'] . '\', \'' . $fila['movil'] . '\', \'' . $fila['activo'] . '\');" ';
                echo 'class="editBtn"></td>';
            }
        }
    
    //  echo '<td class="editTd"><img src="imagenes/editar.png" type="button" ';
    //  echo 'onclick="mostrarEditar(' . $fila['id_Usuario'] . ', \'' . $fila['nombre'] . '\', \'' . $fila['apellido_1'] . '\', \'' . $fila['apellido_2'] . '\', \'' . $fila['sexo'] . '\', \'' . $fila['mail'] . '\', \'' . $fila['movil'] . '\', \'' . $fila['activo'] . '\');" ';
    //  echo 'class="editBtn"></td>';
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


    if ($numPaginas == 1) {
        
    }else{

  // Parte en la que imprimimos el paginador


    if ($numPaginas > 1) {

    echo '<div id="paginador">';
    echo '<span>Página ' . $paginaActual . ' de ' . $numPaginas . '</span>';
    echo '<button onclick="cambiarPagina(0)">Primera</button>';
    echo '<button onclick="cambiarPagina(' . max(0, $paginaActual - 1) . ')">Anterior</button>';

    for ($contadorPagina = max(1, $paginaActual - 2); $contadorPagina <= min($numPaginas - 1, $paginaActual + 2); $contadorPagina++) {
        if ($contadorPagina == $paginaActual) {
            echo '<button class="paginaActual">' . $contadorPagina . '</button>';
        } else {
            echo '<button onclick="cambiarPagina(' . $contadorPagina . ')">' . $contadorPagina . '</button>';
        }
    }

    echo '<button onclick="cambiarPagina(' . min($numPaginas, $paginaActual + 1) . ')">Siguiente</button>';
    echo '<button onclick="cambiarPagina(' . $numPaginas . ')">Última</button>';
    echo '</div>';


    }
}

// echo "Numero users: " . $numUsuarios . " ";
// echo "Numero paginas: " . $numPaginas . " ";
// echo "Pagina actual: " . $paginaActual . " ";
// echo "Inicio: " . $inicio . " ";
?>

