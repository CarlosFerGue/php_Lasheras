<?php
    //Variables que contienen los datos que vamos a mostrar.
    $tipo_datos=$datos['resultados'][0];
    $encabezado_tabla=$datos['resultados'][1];  //Encabezado de la tabla.
    $filasSQL=$datos['resultados'][2];  //Listado de usuarios.
    if($tipo_datos=='Usuarios'){
        $filasTraducidas = usuariosToHtml($filasSQL);
    }
    //Datos correspondientes a la gestión del paginado.
    $paginaActual=$datos['resultados'][3];  //Página actual.
    $resultadosTotales = count($filasSQL);  //Número de usuarios totales.
    $rangoResultados=$datos['resultados'][4];    //Resultados a mostrar por página.
    $paginasTotales=ceil($resultadosTotales/$rangoResultados);  //Número total de páginas.
    $primerResultado=($paginaActual-1)*$rangoResultados; //Posición del primer resultado.
    $ultimoResultado=$primerResultado+($rangoResultados-1); //Obtenemos el ultimo resultado a mostrar.
    $agrupacionPaginas=5;   //Número de botones de páginas máximo a mostrar.
    $margenAgrupacion=floor($agrupacionPaginas/2);

    //Mostramos el encabezado obtenido.
    echo '<table><thead>
            <tr>
              '.$encabezado_tabla.'
            </tr></thead><tbod>';
    //Mostrmos los usuarios, siempre y cuando haya usuarios.
    for($i=$primerResultado ; $i<=$ultimoResultado ; $i++){
        echo $filasTraducidas[$i];
    }
    echo '</tbod></table>';

    echo'<form id="formularioPaginador" name="formularioPaginador">';
    /*echo'<div class="texto_paginador">Página actual: '.$paginaActual.'</div>';*/
    echo'<div class="texto_paginador" id="paginas_totales">Páginas totales: '.$paginasTotales.'</div>';
    //En caso de que estemos en la PRIMERA página, los botones de RETROCEDER página no se mostrarán.
    if($paginaActual!=1){
        echo'
        <div class="boton_paginador" id="pagina_primera" onclick="buscarUsuarios(1)"><<</div>
        <div class="boton_paginador" id="pagina_anterior" onclick="buscarUsuarios('.($paginaActual-1).')"><</div>
        ';
    }
    //Mostramos los botones para ir directamente a cada página (lo remarcamos si la página es la actual).
    if($paginasTotales<=$agrupacionPaginas){
        mostrarPaginasTotales($paginasTotales, $paginaActual);
    } else {
        if($paginaActual<$agrupacionPaginas){
            mostrarPrimerasPaginas($paginaActual,$agrupacionPaginas);
        } else {
            if($paginaActual>=$agrupacionPaginas && $paginaActual<=($paginasTotales-$agrupacionPaginas)){
                mostrarPaginasIntermedias($paginaActual, $margenAgrupacion);}
            if($paginaActual>($paginasTotales-$agrupacionPaginas)){
                mostrarUltimasPaginas($paginasTotales, $agrupacionPaginas, $paginaActual);
            }
        }
    }
    
    //En caso de que estemos en la ÚLTIMA página, los botones de AVANZAR página no se mostrarán.
    if($paginaActual!=$paginasTotales){
        echo'
        <div class="boton_paginador" id="pagina_siguiente" onclick="buscarUsuarios('.($paginaActual+1).')">></div>
        <div class="boton_paginador" id="pagina_ultima" onclick="buscarUsuarios('.$paginasTotales.')">>></div>
        ';
    }
    echo'
        <div class="texto_paginador" id="resultados_totales">Número de resultados: '.$resultadosTotales.'</div>
        <div class="texto_paginador">Resultados por página:</div>
        <input class="input_paginador" id="rangoResultados" type="text" value='.$rangoResultados.'>
        <button class="boton_paginador" id="aplicarRango" type="button" onclick="aplicarRangoResultados();">APLICAR</button>
    </form>
    ';

    //Funciones sobre la tabla.
    function returnGenero($sexo) {
        if ($sexo == 'H') {
            return "Masculino" ;
        } elseif ($sexo == 'M') {
            return "Femenino";
        }
    }
    function returnActivo($activo){
        if($activo == 'S'){
            return "Activo";
        }elseif($activo == 'N'){
            return"Inactivo";
        }
    }
    function usuariosToHtml($usuariosSQL){
        $usuariosTraducidos = array();
        foreach ($usuariosSQL as $usuario) {
            $stringUsuario = '<tr class="filaTr">';
            $stringUsuario .= '<td class="tdNum">'.$usuario['id_Usuario'].'</td>';
            $stringUsuario .= '<td>'.$usuario['nombre'].'</td>';
            $stringUsuario .= '<td>'.$usuario['apellido_1'].'</td>';
            $stringUsuario .= '<td>'.$usuario['apellido_2'].'</td>';
            $stringUsuario .= '<td>'.returnGenero($usuario['sexo']).'</td>';
            $stringUsuario .= '<td>'.$usuario['mail'].'</td>';
            $stringUsuario .= '<td>'.$usuario['movil'].'</td>';
            $stringUsuario .= '<td>'.returnActivo($usuario['activo']).'</td>';
            $stringUsuario .= comprobarEditar($usuario);
            $stringUsuario .= '</tr>';
            //Añadimos la cadena del usuario al array.
            $usuariosTraducidos[] = $stringUsuario;
        }
        return $usuariosTraducidos;

    }
    //Funciones sobre el mostrado del paginador.
    function mostrarPaginasTotales($paginasTotales, $paginaActual){
        for($i=1 ; $i<=$paginasTotales ; $i++){
            if($i==$paginaActual){
                echo'<div class="boton_paginador" id="boton_pagina_actual" onclick="buscarUsuarios('.$i.')">'.$i.'</div>';
            } else {
                echo'<div class="boton_paginador" onclick="buscarUsuarios('.$i.')">'.$i.'</div>';
            }
        }
    }
    function mostrarPrimerasPaginas($paginaActual,$agrupacionPaginas){
        for($i=1 ; $i<=$agrupacionPaginas ; $i++){
            if($i==$paginaActual){
                echo'<div class="boton_paginador" id="boton_pagina_actual" onclick="buscarUsuarios('.$i.')">'.$i.'</div>';
            } else {
                echo'<div class="boton_paginador" onclick="buscarUsuarios('.$i.')">'.$i.'</div>';
            }
        }
        echo'<div class="texto_paginador">...</div>';
    }
    function mostrarPaginasIntermedias($paginaActual, $margenAgrupacion){
        echo'<div class="texto_paginador">...</div>';
        for($i=($paginaActual-$margenAgrupacion) ; $i<=$paginaActual+$margenAgrupacion ; $i++){
            if($i==$paginaActual){
                echo'<div class="boton_paginador" id="boton_pagina_actual" onclick="buscarUsuarios('.$i.')">'.$i.'</div>';
            } else {
                echo'<div class="boton_paginador" onclick="buscarUsuarios('.$i.')">'.$i.'</div>';
            }
        }
        echo'<div class="texto_paginador">...</div>';
    }
    function mostrarUltimasPaginas($paginasTotales, $agrupacionPaginas, $paginaActual){
        echo'<div class="texto_paginador">...</div>';
        for($i=($paginasTotales-$agrupacionPaginas+1) ; $i<=$paginasTotales ; $i++){
            if($i==$paginaActual){
                echo'<div class="boton_paginador" id="boton_pagina_actual" onclick="buscarUsuarios('.$i.')">'.$i.'</div>';
            } else {
                echo'<div class="boton_paginador" onclick="buscarUsuarios('.$i.')">'.$i.'</div>';
            }
        }
    }
    //Función con la que comprobaremos si el usuario cuenta con permisos para editar usuarios.
    function comprobarEditar($usuario){
        $id_permiso = 63;
        $tiene_permiso = 0;
        foreach ($_SESSION['permisos'] as $permiso){
            if ($permiso['idPermiso'] == $id_permiso){
                $tiene_permiso = 1;
            }
        }
        if($tiene_permiso == 1){
            $string_editar = '<td class="editTd"><img src="imagenes/edit.png" type="button" ';
            $string_editar .= 'onclick="mostrarEditar(' . $usuario['id_Usuario'] . ', \'' . $usuario['nombre'] . '\', \'' . $usuario['apellido_1'] . '\', \'' . $usuario['apellido_2'] . '\', \'' . $usuario['sexo'] . '\', \'' . $usuario['mail'] . '\', \'' . $usuario['movil'] . '\', \'' . $usuario['activo'] . '\');" ';
            $string_editar .= 'class="editBtn"></td>';
            return $string_editar;
        } else if($tiene_permiso == 0) {
            $string_editar = '<td class="editTd"><img src="imagenes/edit.png" ';
            $string_editar .= 'class="editBtnGrey"></td>';
            return $string_editar;
        }
    }

?>
