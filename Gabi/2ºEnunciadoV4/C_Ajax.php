<?php
session_start();

$getPost = array_merge($_POST, $_GET, $_FILES);

if (isset($getPost['controlador'], $getPost['metodo'])) {
    $controlador = 'C_' . $getPost['controlador'];
    $metodo = $getPost['metodo'];

    $rutaControlador = './controladores/' . $controlador . '.php';

    if (file_exists($rutaControlador)) {
        require_once $rutaControlador;

        $objControlador = new $controlador();

        if (method_exists($objControlador, $metodo)) {
            $objControlador->$metodo($getPost);
        } else {
            echo 'Error AX-04';
        }
    } else {
        echo 'Error AX-03';
    }
} else {
    echo 'Error AX-01';
}
?>