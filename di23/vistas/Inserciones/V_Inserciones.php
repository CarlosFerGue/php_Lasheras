<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/V_Inserciones.css">
</head>

<body>
    
    <div id="container">
        <form id="formularioInsertar" name="formularioInsertar" onkeydown="return event.key != 'Enter';">
            <label for="b_nombre">Nombre del usuario:</label>
            <input type="text" id="b_nombre" name="b_nombre">
            
            <label for="b_apellido1">Apellido 1:</label>
            <input type="text" id="b_apellido1" name="b_apellido1">
            
            <label for="b_apellido2">Apellido 2:</label>
            <input type="text" id="b_apellido2" name="b_apellido2">
            
            <label for="b_sexo">Sexo:</label>
            <input type="text" id="b_sexo" name="b_sexo">
            
            <label for="b_email">Email:</label>
            <input type="text" id="b_email" name="b_email">
            
            <label for="b_movil">Movil:</label>
            <input type="text" id="b_movil" name="b_movil">

            <label for="b_user">Nombre de usuario:</label>
            <input type="text" id="b_user" name="b_user">

            <label for="b_pass">Contraseña:</label>
            <input type="text" id="b_pass" name="b_pass">

            <button type="button" onclick="insertarUsuario()">Añadir usuario</button>
        </form>

        

    </div>

    <div id="CapaResultadoBusqueda">
        <!-- Aquí se mostrarán los resultados de la búsqueda -->
    </div>


</body>

</html>