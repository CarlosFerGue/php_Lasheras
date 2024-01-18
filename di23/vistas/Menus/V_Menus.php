<head>
    <link rel="icon" href="imagenes/87.ico" type="image/x-icon">
    <link rel="shortcut icon" href="imagenes/87.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    </link>
    <script src="js/app.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/menu.css">
</head>

<section id="secMenuPagina" class="container-fluid">

    <div id="navBarRellenar" class="navbar navbar-expand-sm navbar-light" style="background-color: #e3f2fd;" aria-label="Fourth navbar example">
        <?php

        $menus = $datos['menus'];


        // foreach ($menus as $fila) {
        //     echo '<tr class="filaTr">';
        //     echo '<td>' . $fila['nombre'] . '</td>';
        //     echo '<td>' . returnPrivado($fila) . '</td>';
        //     echo '</tr>';
        //     echo '<tr><td colspan="5"><br></td></tr>';  
        // }
        // echo '</table>';



        foreach ($menus as $fila) {
            echo $fila['nombre'] . ' - ' . $fila['privado'] . '<br>';
        }

        function returnPrivado($fila)
        {
            if ($fila['privado'] == 'N') {
                return "Publico";
            } elseif ($fila['privado'] == 'S') {
                return "Privado";
            }
        }
        ?>
    </div>
</section>