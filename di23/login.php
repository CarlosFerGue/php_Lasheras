<?php session_start();
$usuario = '';
$pass = '';
$rol = '';
$permiso = '';
$rolYPermisos = '';
$mensa = '';
extract($_POST);


if ($usuario == '' || $pass == '') {
    $mensa = 'Debes completar los campos';
} else {
    require_once 'controladores/C_Usuarios.php';
    $objUsuarios = new C_Usuarios();
    $datos['usuario'] = $usuario;
    $datos['pass'] = $pass;


    $resultado = $objUsuarios->validarUsuario(array(
        'usuario' => $usuario,
        'pass' => $pass,
    ));

    //login.php - C_Usuarios - M_Usuarios Ruta que sigue hasta el fondo del back
    $resultadoRolPermiso = $objUsuarios->getRolesyPermisos(array(
        'usuario' => $usuario,
        'pass' => $pass, 
    ));




    //Este es el lugar donde procesaremos los permisos
    if ($resultado == 'S') {
        $usuarioRoles = array();
        $usuarioPermisos = array();
    
        foreach ($resultadoRolPermiso as $row) {
            // Obtener los roles del usuario
            if (!in_array($row['Id_roles'], $usuarioRoles) && $row['Id_roles'] !== null) {
                $usuarioRoles[] = $row['Id_roles'];
            }
    
            // Obtener los permisos del usuario
            if (!in_array($row['Id_permisos'], $usuarioPermisos) && $row['Id_permisos'] !== null) {
                $usuarioPermisos[] = $row['Id_permisos'];
            }
        }
    
        // Ahora puedes manejar los roles y permisos obtenidos
        // Por ejemplo, almacenarlos en variables de sesión, realizar redireccionamientos, etc.
    
        // Redireccionar según el primer rol obtenido (asumiendo que es el principal)
        switch ($usuarioRoles[0]) {
            case '1':
                header('Location: index.php');
                break;
            case '2':
                header('Location: login.php');
                break;
            case '3':
                header('Location: lal.php');
                break;
            default:
                header('Location: no-permisos.php');
                break;
        }
    }


    //Aqui procesamos la logica de los permisos que son inferiores a los roles
    switch ($permiso) {
        case '1':
            $rolYPermisos .= " permiso 1";
            break;
        case '2':
            $rolYPermisos .= " permiso 2";
            break;
        case '3':
            $rolYPermisos .= " permiso 3";
            break;
        default:
            $rolYPermisos .= " no tiene permisos";
            break;
    }
}
?>




<!-- Aqui esta el front y back del login -->

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
            <span id="msj"><?php echo $rolYPermisos; ?></span>

            <button type="button" id="aceptar" onclick="validar()">Aceptar</button>



        </form>

    </div>
</body>

</html>