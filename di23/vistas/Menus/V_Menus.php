<head>
    <link rel="icon" href="imagenes/87.ico" type="image/x-icon">
    <link rel="shortcut icon" href="imagenes/87.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    </link>
    <script src="js/app.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <!-- <link rel="stylesheet" href="css/menu.css"> -->
</head>

<section id="secMenuPagina" class="container-fluid">

    <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #e3f2fd;" aria-label="Fourth navbar example">
        <?php
        $menus = $datos['menus'];

        foreach ($menus as $index => $fila) {
            echo $fila['nombre'] . ' - ' . returnPrivado($fila);
        ?>
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <?php if ($index === 0) : ?>
                        <a class="nav-link active" aria-current="page" href="<?php echo $fila['URL']; ?>"><?php echo $fila['nombre']; ?></a>
                    <?php else : ?>
                        <a class="nav-link" href="<?php echo $fila['URL']; ?>"><?php echo $fila['nombre']; ?></a>
                    <?php endif; ?>
                </li>
                <!-- Los otros elementos del menú permanecen iguales -->
            </ul>
        <?php
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
    </nav>

</section>
<script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="js/app.js"></script>