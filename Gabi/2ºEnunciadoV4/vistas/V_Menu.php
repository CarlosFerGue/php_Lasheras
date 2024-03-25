<?php
    //Obtenemos los datos del menú.
    $filasMenu=$datos['menu'];
    //Creamos el array de PADRES que contenga un subarray con los HIJOS en caso de que los tenga.
    $padres = array();
    foreach ($filasMenu as $fila) {
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
    //Imprimimos el array para comprobar que los datos han sido añadidos correctamente.
    //foreach($padres as $padre){echo print_r($padre);echo '<br>';}

    //Abrimos el contenedor de los elementos del MENÚ
    echo '<section id="secMenuPagina" class="container-fluid">';
    echo '<nav class="navbar navbar-expand-sm navbar-light" id="barra">';
    echo '<div class="container-fluid">';
    echo '<div class="collapse navbar-collapse" id="navbarsExample04">';
    echo '<ul class="navbar-nav me-auto mb-2 mb-md-0">';
    //Recorremos cada botón PADRE del menú según si tiene hijos o no.
    foreach($padres as $padre){
        if(empty($padre['hijos'])){
            echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">';
            echo $padre['titulo'];
            echo '</a></li>';
        } else {
            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">'.$padre['titulo'].'</a>';
            echo '<ul class="dropdown-menu">';
            foreach($padre['hijos'] as $hijo){
                echo '<li><a class="dropdown-item" '.$hijo['accion'].'>';
                echo $hijo['titulo'];
                echo '</a></li>';
            }
            echo '</ul>';
            echo '</li>';
        }
    }
    //Cerramos el contenedor de los elementos del MENÚ
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
    echo '</section>';
?>