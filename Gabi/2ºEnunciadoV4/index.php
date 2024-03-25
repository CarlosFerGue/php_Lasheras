<?php session_start();
    if(isset($_SESSION['usuario']) && $_SESSION['usuario']!=''){
    }else{

    }
?>
<!DOCTYPE html>
<html lang="es">
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" 
            href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
        </link>
        <link rel="stylesheet" href="css/Permisos.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/ventanas.css">
        <link rel="stylesheet" href="css/paginado.css">
    </head>
    <body>
        <section id="secEncabezadoPagina" class="container-fluid">
            <div class="row">
                <div class="divLogotipo col-lg-2 col-md-2 col-sm-10">
                    <img src="imagenes/logo.png">
                </div>
                <div class="divTituloApp col-lg-8 col-md-8 d-none d-md-block" id="titulo">Gabriel Milagro López</div>
                <div class="divLog col-lg-2 col-md-2 col-sm-2">
                    <!-- -- -- Controlamos el inicio de sesión. -- -- -->
                    <?php
                        if(isset($_SESSION['usuario'])){
                            echo '<a href="logout.php" title="Salir">';
                            echo '<span id="usuario">'.$_SESSION['usuario'].'</span>';
                            echo    '<img src="imagenes/logout.png" id=loginPng>';
                            echo '</a>';
                            //print_r($_SESSION['permisos']);

                        }else{
                            echo '<a href="login.php" title="Entrar">';
                            echo    '<img src="imagenes/login.png" id=loginPng>';
                            echo '</a>';
                        }
                    ?>
                </div>
            </div>
        </section>
        <!-- -- -- Cargamos los menús según el inicio de sesión. -- -- -->
        <?php
            if(isset($_SESSION['usuario'])){
                // Ejecutamos la carga del menú según la cuenta con la que hemos iniciado sesión.
                require_once 'controladores/C_Menu.php';
                $menu = new C_Menu();
                $menu->cargarMenu($_SESSION['usuario']);
            }else{
                // Ejecutamos la carga del menú sin haber iniciado sesión.
                require_once 'controladores/C_Menu.php';
                $menu = new C_Menu();
                $menu->cargarMenu(NULL);
            }
        ?>
        <!-- <section id="secMenuPagina" class="container-fluid">
            <nav class="navbar navbar-expand-sm navbar-light" id="barra">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled">Disabled</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                     aria-expanded="false">CRUD's</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" 
                                        onclick="getVistaMenuSeleccionado('Usuarios', 'getVistaUsuarios');">Usuarios</a></li>
                                    <li><a class="dropdown-item" href="#"
                                        onclick="getVistaMenuSeleccionado('Pedidos', 'getVistaPedidos')">Pedidos</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </section> -->
        <div id="secMenu" class="container-fluid">
        </div>

        <div id="secContenidoPagina" class="container-fluid">
        </div>
        
        <script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/app.js"></script>
    </body>

</html>