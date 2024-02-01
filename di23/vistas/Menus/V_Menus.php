<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="imagenes/87.ico" type="image/x-icon">
    <link rel="shortcut icon" href="imagenes/87.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- <link rel="stylesheet" href="css/menu.css"> -->
</head>

<body>

    <section id="secMenuPagina" class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #e3f2fd;" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <?php
                        $menus = $datos['menus'];

                        foreach ($menus as $menu) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" 
                                onclick="getVistaMenuSeleccionado('<?php echo $menu['controlador']; ?>', '<?php echo $menu['model']; ?>')">
                                    <?php echo $menu['nombre']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    

    <script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
