<?php session_start();
    unset($_SESSION['usuario']);
    unset($_SESSION['permisos']);
    header('Location: index.php');
?>