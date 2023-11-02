<?php session_start();
    if(isset($_SESSION['usuario']) && $_SESSION['usuario']!=''){
        //esta logeado
    }else{
        //header('Location: login.php');
    }
    // https://es.cooltext.com/
?>
<!DOCTYPE html>
<html lang="es">
<html>
    <head>
        <meta name="viewport" 
            content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" 
            href="librerias/bootstrap-5.1.3-dist/css/bootstrap.min.css">
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
                <div class="divTituloApp col-lg-8 col-md-8 d-none d-md-block">Carlos Fernández Guevara</div>
                <div class="divLog col-lg-2 col-md-2 col-sm-2">
                    <?php
                        if(isset($_SESSION['usuario'])){ // Comprubea si la variable usuario existe
                            echo '<a href="logout.php" title="Salir">'; //Muestras el LOG OUT
                            echo $_SESSION['usuario']; //Esto mostrara el nombre del usuario arriba a la derecha
                            echo    '<img src="imagenes/logout.jpg">'; //Ciruculo rojo con flecha
                            echo '</a>';
                            //Si ve que existe esta variable, significa qeu esta logeado el usuario
                            //Y hace visible le log out
                        }else{
                            echo '<a href="login.php" title="Entrar">'; //Muestras el LOGIN
                            echo    '<img src="imagenes/login.png">';//Circulo verde con flecha
                            echo '</a>';
                            //Si no detcta que existe la variable usuario, significa que no 
                            //hay usuarios logeados y muestra el log in
                        }
                    ?>
                </div>
            </div>
        </section>
        <section id="secMenuPagina" class="container-fluid">
            
            <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #e3f2fd;" aria-label="Fourth navbar example">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

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
                                        onclick="getVistaMenuSeleccionado('Usuarios', 'getVistaUsuarios')">Usuarios</a></li>
                                    <li><a class="dropdown-item" href="#"
                                        onclick="getVistaMenuSeleccionado('Pedidos', 'getVistaPedidos')">Pedidos</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


        </section>
        <section id="secContenidoPagina" class="container-fluid">

        </section>
        
        



        <script src="librerias/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>