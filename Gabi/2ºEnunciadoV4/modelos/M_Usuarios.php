<?php
ini_set('display_errors', 'Off');
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Usuarios extends Modelo{
    public $DAO;

    public function __construct(){
        parent::__construct(); //ejecuta constructor padre
        $this->DAO = new DAO();
    }

    public function buscarPermisos($login){
        $permisos = array();
        $SQL="SELECT P.idPermiso, P.permiso
                FROM usuarios U, permisos_usuarios PU, permisos P, roles R, permisos_roles PR, roles_usuarios RU
                WHERE (U.login = '$login'
                        AND U.id_Usuario = RU.id_Usuario
                        AND RU.idRol = R.idRol
                        AND R.idRol = PR.idRol
                        AND PR.idPermiso = P.idPermiso)
                    OR (U.login = '$login'
                        AND U.id_Usuario = PU.id_Usuario
                        AND PU.idPermiso = P.idPermiso)
                GROUP BY P.idPermiso
                ORDER BY P.idPermiso;";
        $permisos = $this->DAO->consultar($SQL);
        return $permisos;
    }

    public function buscarUsuario($filtro=array()){
        //Datos Login
        $usuario='';
        $pass='';
        extract($filtro);

        $SQL="SELECT * FROM usuarios WHERE 1=1";

        if ($usuario!='' && $pass!='') {
            $usuario=addslashes($usuario);
            $pass=addslashes($pass);
            $SQL.= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }
        $usuarios= $this->DAO->consultar($SQL);
        return $usuarios;
    }

    public function buscarUsuarios($filtro=array()){
        //Conficuramos el encavezado que le vamos a pasar a la vista.
        $encabezadoTabla='
            <th>ID</th>
            <th>NOMBRE</th>
            <th>APELLIDO 1</th>
            <th>APELLIDO 2</th>
            <th>SEXO</th>
            <th>CORREO</th>
            <th>TELÉFONO</th>
            <th>ACTIVIDAD</th>
            <th class="editTh">EDITAR</th>
        ';
        //Obtenemos los datos de búsqueda.
        extract($filtro);
        $SQL="SELECT * FROM usuarios WHERE 1=1";
        
        if($busquedas!=''){
            $aTexto=explode(' ', $busquedas);
            $SQL.=" AND (1=2 ";
            foreach($aTexto as $palabra){
                $SQL.=" OR apellido_1 LIKE '%$palabra%' ";
                $SQL.=" OR apellido_2 LIKE '%$palabra%' ";
                $SQL.=" OR nombre LIKE '%$palabra%' ";
            }
            $SQL.=") ";
        } if($genero!=''){
            $SQL.=" AND (1=2 ";
            $SQL.=" OR sexo LIKE '%$genero%' ";
            $SQL.=") ";
        } if($telefono!=''){
            $SQL.=" AND (1=2 ";
            $SQL.=" OR movil LIKE '%$telefono%' ";
            $SQL.=") ";
        } if($actividad!=''){
            $SQL.=" AND (1=2 ";
            $SQL.=" OR activo LIKE '%$actividad%' ";
            $SQL.=") ";
        }
        //Configuramos el limitador por página.
        $usuariosTotales = $this->DAO->consultar($SQL); //Obtenemos el listado de resultados.
        $tipo_datos = 'Usuarios';
        return [$tipo_datos, $encabezadoTabla, $usuariosTotales, $pagina_actual, $rango_resultados];
    }

    public function guardarUsuario($parametros=array()){
        extract($parametros);
        //Hacemos la comprobación del nombre de usuario.
        $loginValido = FALSE;
        $comprobarLogin = $this->DAO->insertar("SELECT COUNT(login) AS numLogins FROM usuarios WHERE login = '$usuarioEdt'");
        $numLogins = $comprobarLogin[0]['numLogins'];
        if($numLogins==0){
            $loginValido = TRUE;
        }
        //Construimos el INSERT/UPDATE según si se especifica la ID o no.
        if($idEdt==''){
            $SQL="INSERT INTO usuarios (nombre, apellido_1, apellido_2, sexo, fecha_Alta, mail, movil, login, pass, activo) VALUES (";
            $SQL .= "'$nombreEdt', '$apellido1Edt', '$apellido2Edt', '$generoEdt', NOW(), '$correoEdt', '$telefonoEdt', '$usuarioEdt', md5('$passwordEdt'), '$actividadEdt' )";
        }else{
            $SQL="UPDATE usuarios SET nombre='$nombreEdt',apellido_1='$apellido1Edt',apellido_2='$apellido2Edt',sexo='$generoEdt',mail='$correoEdt',movil='$telefonoEdt',activo='$actividadEdt' WHERE id_usuario = $idEdt;";
        }
        if($loginValido==TRUE){
            $this->DAO->insertar($SQL);
        }
        
    }
}
?>