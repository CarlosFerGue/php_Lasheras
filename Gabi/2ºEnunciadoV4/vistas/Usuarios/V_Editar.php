<form class="recuadro" id="editarUsuario" name="editarUsuario">
    <img src="../../imagenes/close.jpg" alt="CERRAR VENTANA" id="close" type="button" onclick="cerrarVentanas();">
    <div id="tituloEdt">TITULO</div>
    <input type="text" id="idEdt" name="idEdt"  class="field">
    <label for="usuarioEdt" class="label" id="usuarioLabel">USUARIO:</label>
    <input type="text" id="usuarioEdt" name="usuarioEdt"  class="field"><br id="usuarioBr">
    <label for="passwordEdt" class="label" id="passwordLabel">CONTRASEÑA:</label>
    <input type="text" id="passwordEdt" name="passwordEdt"  class="field"><br id="passwordBr">
    <label for="nombreEdt" class="label">NOMBRE:</label>
    <input type="text" id="nombreEdt" name="nombreEdt"  class="field"><br>
    <label for="apellido1Edt" class="label">APELLIDO 1:</label>
    <input type="text" id="apellido1Edt" name="apellido1Edt"  class="field"><br>
    <label for="apellido2Edt" class="label">APELLIDO 2:</label>
    <input type="text" id="apellido2Edt" name="apellido2Edt"  class="field"><br>
    <label class="label" style="margin-top: 5px;">SEXO:</label>
    <div class="selector">
        <div class="selection">
            <input type="radio" id="masculinoEdt" value="H" name="generoEdt" class="radio">
            <label for="masculinoEdt">Masculino</label>
        </div>
        <div class="selection">
            <input type="radio" id="femeninoEdt" value="M" name="generoEdt" class="radio">
            <label for="femeninoEdt">Femenino</label>
        </div>
    </div>
    <label for="correoEdt" class="label">CORREO ELECTRÓNICO:</label>
    <input type="email" id="correoEdt" name="correoEdt"   class="field"><br>
    <label for="telefono" class="label">TELÉFONO:</label>
    <input type="text" id="telefonoEdt" name="telefonoEdt"  class="field"><br>
    
    <label class="label" style="margin-top: 7px;">ACTIVIDAD:</label>
    <div class="selector">
        <div class="selection">
            <input type="radio" id="activoEdt" value="S" name="actividadEdt" class="radio">
            <label for="activoEdt">Activo</label>
        </div>
        <div class="selection">
            <input type="radio" id="inactivoEdt" value="N" name="actividadEdt" class="radio">
            <label for="inactivoEdt">Inactivo</label>
        </div>
    </div>
    <button class="añadir" id="boton" type="button">GUARDAR USUARIO</button>

    <div id="error"></div>
</form>