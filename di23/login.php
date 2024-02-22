<?php session_start();
$usuario = '';
$pass = '';
$rol = '';
$permiso = '';
extract($_POST);
//var_dump($_POST);
if ($usuario == '' || $pass == '') {
    $mensa = 'Debes completar los campos';
} else {
    require_once 'controladores/C_Usuarios.php';
    $objUsuarios = new C_Usuarios();
    $datos['usuario'] = $usuario;
    $datos['pass'] = $pass;
    //$resultado=$objUsuarios->validarUsuario($datos);

    $resultado = $objUsuarios->validarUsuario(array(
        'usuario' => $usuario,
        'pass' => $pass,
    ));

    $resultadoRolPermiso = $objUsuarios->getRolesyPermisos(array(
        'usuario' => $usuario,
        'pass' => $pass,
    ));


    

    $rol = $resultadoRolPermiso[0]['id_Rol'];
    $permiso = $resultadoRolPermiso[0]['id_Permiso'];

    // echo $rol;
    // echo $permiso;
    //var_dump($resultadoRolPermiso);

    //Este es el lugar donde procesaremos los permisos
    if ($resultado == 'S') {
        // header('Location: index.php');
    } else {
        $mensa = 'Datos incorrectos, intentalo de nuevo';
    }

    ///////////////////////////////////////////////

    switch ($rol) {
        case '1':
            $mensa = "rol 1";
            header('Location: index.php');
            break;
        case '2':
            $mensa = "rol 2";
            header('Location: login.php');
            break;
        case '3':
            $mensa = "rol 3";
            header('Location: lal.php');
            break;
        default:
            $mensa = "no tiene permisos";
            break;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript">
        function validar() {
            const usuario = document.getElementById("usuario");
            const pass = document.getElementById("pass");
            let mensaje = '';
            if (usuario.value == '' || pass.value == '') {
                mensaje = 'Debes completar los campos';
            } else {
                //enviar formulario
                document.getElementById("formularioLogin").submit();
            }
            document.getElementById("msj").innerHTML = mensaje;
        }
    </script>
    <link rel="stylesheet" href="css/login.css">
</head>


<body>
    <a href="index.php" class="volver-link">
        <h2 id="mi-encabezado">Volver</h2>
    </a>

    <div id="contenedor">
        <form id="formularioLogin" name="formularioLogin" method="post" action="login.php">


            <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>">
            <br>


            <label for="pass">Contraseña:</label><br>
            <input type="password" id="pass" name="pass" value="<?php echo $pass; ?>"><br>
            <span id="msj"><?php echo $mensa; ?></span>

            <button type="button" id="aceptar" onclick="validar()">Aceptar</button>



        </form>

    </div>
</body>

</html>