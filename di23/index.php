<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="imagenes/87.ico" type="image/x-icon">
    <link rel="shortcut icon" href="imagenes/87.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <script src="js/app.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/menu.css">

    <?php
    // Inicia la sesión en PHP
    session_start();
    // Obtiene el rol y los permisos de las sesiones
    $rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
    $permisos = isset($_SESSION['permisos']) ? $_SESSION['permisos'] : array();

    // Ahora puedes utilizar $rol y $permisos en tu segundo código como lo necesites
    // Por ejemplo, puedes mostrar el rol y los permisos en tu página HTML
    echo "Rol: " . $rol . "<br>";
    echo "Permisos: ";
    foreach ($permisos as $permiso) {
        echo $permiso . " ";
    }

    // Comprueba si la variable de sesión 'usuario' está establecida
    if (isset($_SESSION['usuario'])) {
        // Si el usuario ha iniciado sesión, genera un script para llamar a la función deseada
        $scriptComprobarLogin = 'getVistaMenuSeleccionado("Menus", "getVistaMenus");';
    } else {
        // Si el usuario no ha iniciado sesión, muestra una alerta
        $scriptComprobarLogin = 'alert("Si tienes cuenta puedes iniciar sesión, sino puedes entrar como invitado");';
    }
    ?>

    <script>
        function redirectToLogin() {
            window.location.href = "login.php";
        }

        function comprobarLogin() {
            <?php echo $scriptComprobarLogin; ?>
        }
    </script>

</head>

<body onload="comprobarLogin()">


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

    <!-- 
    <section id="secMenusPagina" class="container-fluid">
        <div class="d-flex justify-content-center mt-5">
            <button onclick="getVistaMenuSeleccionado('Menus', 'getVistaMenus')" type="button" class="btn btn-primary me-3">Tengo cuenta</button>
            <button type="button" class="btn btn-secondary">Entrar como invitado</button>
        </div>
    </section> -->

    <section id="secMenusPagina" class="container-fluid">
        <div class="d-flex justify-content-center mt-5">
            <button onclick="redirectToLogin()" type="button" class="btn btn-primary me-3">Tengo cuenta</button>
            <button type="button" class="btn btn-secondary">Entrar como invitado</button>
        </div>
    </section>

    <section id="secContenidoPagina" class="container-fluid">

    </section>



    <script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>