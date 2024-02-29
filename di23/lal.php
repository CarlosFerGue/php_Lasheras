<?php
session_start();
// Accede a las variables de sesión
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
$permiso = isset($_SESSION['permiso']) ? $_SESSION['permiso'] : '';

echo $rol . $permiso;
?>
