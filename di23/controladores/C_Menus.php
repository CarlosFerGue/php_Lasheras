<?php
session_start();

class C_Menu {
    // Aquí iría la lógica de la clase C_Menu, como el método getMenuBD()
    public function getMenuBD() {
        // Lógica para obtener el menú desde la base de datos
    }
}

$getPost = array_merge($_POST, $_GET, $_FILES);

if (isset($getPost['controlador'])) {
    $controlador = 'C_' . $getPost['controlador'];
    
    if (isset($getPost['metodo'])) {
        $metodo = $getPost['metodo'];
        
        if (file_exists('./controladores/' . $controlador . '.php')) {
            require_once './controladores/' . $controlador . '.php';
            
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
        echo 'Error AX-02';
    }
} else {
    echo 'Error AX-01';
}
?>
