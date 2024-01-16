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

<body>
    <section id="secEncabezadoPagina" class="container-fluid">
        <div class="row">

            <div class="divLogotipo col-lg-2 col-md-2 col-sm-10">
                <img src="imagenes/logo.png">
            </div>

            <div class="divTituloApp col-lg-8 col-md-8 d-none d-md-block">
                <H1>Carlos Fernández Guevara</H1>
            </div>

            <div class="divLog col-lg-2 col-md-2 col-sm-2">
                <?php
                if (isset($_SESSION['usuario'])) { // Comprubea si la variable usuario existe
                    echo '<a href="logout.php" title="Salir">'; //Muestras el LOG OUT
                    echo $_SESSION['usuario']; //Esto mostrara el nombre del usuario arriba a la derecha
                    echo    '<img src="imagenes/logout.png">'; //Ciruculo rojo con flecha
                    echo '</a>';
                    //Si ve que existe esta variable, significa qeu esta logeado el usuario
                    //Y hace visible le log out
                } else {
                    echo '<a href="login.php" title="Entrar">'; //Muestras el LOGIN
                    echo    '<img src="imagenes/login.png">'; //Circulo verde con flecha
                    echo '</a>';
                    //Si no detcta que existe la variable usuario, significa que no 
                    //hay usuarios logeados y muestra el log in
                }
                ?>
            </div>
        </div>
    </section>

    <section id="secContenidoPagina" class="container-fluid">
        <div class="d-flex justify-content-center mt-5">
            <button onclick="getVistaMenuSeleccionado('Menus', 'getVistaMenus')" type="button" class="btn btn-primary me-3"></button>
            <button type="button" class="btn btn-secondary">Entrar como invitado</button>
        </div>
    </section>


    <section id="secContenidoPagina" class="container-fluid"></section>

    <script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>