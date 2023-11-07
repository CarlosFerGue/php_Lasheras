<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/V_Usuarios.css">
</head>
<body>

    <form id="formularioBuscar" name="formularioBuscar" onkeydown="return event.key != 'Enter';">
        <label for="b_texto">Buscar por nombre de usuario:</label>
        <input type="text" id="b_texto" name="b_texto" >
        <!-- <button type="button" onclick="buscarUsuarios()">Buscar</button> -->
    </form>

    <form id="formularioBuscarTelefono" name="formularioBuscarTelefono" onkeydown="return event.key != 'Enter';">
        <label for="b_telefono">Buscar por número de teléfono:</label>
        <input type="text" id="b_telefono" name="b_telefono">
        <!-- <button type="button" onclick="buscarTelefono()">Buscar</button> -->
        <button type="button" onclick="buscar()">Buscar</button> 
    </form>

    

    <div id="CapaResultadoBusqueda">
        <!-- Aquí se mostrarán los resultados de la búsqueda -->
    </div>

</body>
</html>
