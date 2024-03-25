<?php
ini_set('display_errors', 'Off');
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Permisos extends Modelo{
    public $DAO;

    public function __construct(){
        parent::__construct(); //ejecuta constructor padre
        $this->DAO = new DAO();
    }

    public function buscarUsuariosRoles(){
        $usuarios = $this->DAO->consultar("SELECT id_Usuario, login FROM usuarios ORDER BY id_Usuario");
        $roles = $this->DAO->consultar("SELECT idRol, rol FROM roles ORDER BY idRol");
        return [$usuarios,$roles];
    }

    public function buscarMenus($filtro=array()){
        //Obtenemos los datos de búsqueda.
        extract($filtro);

        //Generamos la sentencia SQL en base a los datos del formulario.
        $SQL="SELECT * FROM menu WHERE 1=1";
        if($busquedas!=''){
            $SQL.=" AND titulo LIKE '%$busquedas%'";
        }
        $SQL.=' ORDER BY idPadre, orden ASC';

        //Obtenemos los datos de los menus e IDs de permisos y los mandamos al controlador.
        $menus = $this->DAO->consultar($SQL);
        $permisos = $this->DAO->consultar("SELECT P.idPermiso, P.permiso, PM.idMenu FROM permisos P INNER JOIN permisos_menu PM ON P.idPermiso = PM.idPermiso");

        //En caso de que haya especificado un rol o usuario, guardamos los permisos asignados para dejarlos marcados en pantalla.
        if($idRol != 0 ){
            $permisos_asignados = $this->DAO->consultar("SELECT idPermiso FROM permisos_roles WHERE idRol=$idRol");
        }
        if($id_Usuario != 0){
            $SQL="SELECT P.idPermiso
            FROM usuarios U, permisos_usuarios PU, permisos P, menu M, permisos_menu PM, roles R, permisos_roles PR, roles_usuarios RU
            WHERE (U.id_Usuario = $id_Usuario
                    AND U.id_Usuario = RU.id_Usuario
                    AND RU.idRol = R.idRol
                    AND R.idRol = PR.idRol
                    AND PR.idPermiso = P.idPermiso)
                OR (U.id_Usuario = $id_Usuario
                    AND U.id_Usuario = PU.id_Usuario
                    AND PU.idPermiso = P.idPermiso)
            GROUP BY P.idPermiso
            ORDER BY P.idPermiso;";
            $permisos_asignados = $this->DAO->consultar($SQL);
        }
        if($id_Usuario==0 && $idRol==0){
            $permisos_asignados = 0;
        }

        return [$menus,$permisos, $permisos_asignados];
    }

    public function borrarMenu($filtro=array()){
        //Obtenemos la id de borrado.
        extract($filtro);

        //Primero borramos las uniones de permisos con roles, usuarios, menús y los propios permisos.
        $permisos = $this->DAO->consultar("SELECT idPermiso FROM permisos_menu WHERE idMenu=".$id);
        foreach($permisos as $permiso){
            $id_permiso = $permiso['idPermiso'];
            $this->DAO->borrar("DELETE FROM permisos_roles WHERE idPermiso=".$id_permiso);
            $this->DAO->borrar("DELETE FROM permisos_usuarios WHERE idPermiso=".$id_permiso);
            $this->DAO->borrar("DELETE FROM permisos_menu WHERE idPermiso=".$id_permiso);
            $this->DAO->borrar("DELETE FROM permisos WHERE idPermiso=".$id_permiso);
        }

        //Obtenemos y actualizamos los menús posteriores, reduciendo su orden en 1.
        $orden = $this->DAO->consultar("SELECT orden FROM menu WHERE idMenu=".$id);
        $this->DAO->actualizar("UPDATE menu SET orden=orden-1 WHERE orden>".$orden[0]['orden']);
        
        //Sentencia de borrado.
        $this->DAO->borrar("DELETE FROM menu WHERE idMenu=".$id);
    }

    public function actualizarMenu($filtro=array()){
        //Obtenemos la id de actualización y los datos del formulario  .
        extract($filtro);
        $accion = addslashes($accion);

        //Ejecutamos la sentencia de actualización.
        $this->DAO->actualizar("UPDATE menu SET privado=$privado, accion='$accion' WHERE idMenu=$id");
    }

    public function asignarPermiso($filtro=array()){
        extract($filtro);
        //Decidimos si se va a gestionar sobre un usuario o sobre un rol.
        if($id_Usuario != 0){
            //Comprobamos si el usuario ya tiene el permiso. Si no lo tiene, lo asignaremos, sino, lo eliminaremos.
            $permisos = $this->DAO->consultar("SELECT idPermiso FROM permisos_usuarios WHERE idPermiso=$idPermiso AND id_Usuario=$id_Usuario");
            if(empty($permisos)){
                $this->DAO->insertar("INSERT INTO permisos_usuarios (idPermiso, id_Usuario) VALUES ($idPermiso, $id_Usuario)");
            }
            if(!empty($permisos)){
                $this->DAO->borrar("DELETE FROM permisos_usuarios WHERE idPermiso=$idPermiso AND id_Usuario=$id_Usuario");
            }
        }
        if($idRol != 0){
            //Comprobamos si el usuario ya tiene el permiso. Si no lo tiene, lo asignaremos, sino, lo eliminaremos.
            $permisos = $this->DAO->consultar("SELECT idPermiso FROM permisos_roles WHERE idPermiso=$idPermiso AND idRol=$idRol");
            if(empty($permisos)){
                $this->DAO->insertar("INSERT INTO permisos_roles (idPermiso, idRol) VALUES ($idPermiso, $idRol)");
            }
            if(!empty($permisos)){
                $this->DAO->borrar("DELETE FROM permisos_roles WHERE idPermiso=$idPermiso AND idRol=$idRol");
            }
        }
    }

    public function eliminarPermiso($filtro=array()){
        //Obtenemos la id de actualización y los datos del formulario  .
        extract($filtro);

        //Eliminamos las asociaciones con el resto de tablas.
        $this->DAO->borrar("DELETE FROM permisos_roles WHERE idPermiso=$idPermiso");
        $this->DAO->borrar("DELETE FROM permisos_usuarios WHERE idPermiso=$idPermiso");
        $this->DAO->borrar("DELETE FROM permisos_menu WHERE idPermiso=$idPermiso");
        $this->DAO->borrar("DELETE FROM permisos WHERE idPermiso=$idPermiso");
    }

    public function anadirMenu($filtro=array()){
        //Obtenemos la id de actualización y los datos del formulario  .
        extract($filtro);
        $titulo = addslashes($titulo);
        $accion = addslashes($accion);

        //Actualizamos los orden de los menús posteriores.
        $this->DAO->actualizar("UPDATE menu SET orden=orden+1 WHERE orden>=$orden");

        //Insertamos el menu nuevo en la base de datos.
        if($idPadre==0){
            $this->DAO->insertar("INSERT INTO menu (titulo, privado, accion, orden) VALUES ('$titulo',$privado,'$accion',$orden)");
        } else if ($idPadre!=0){
            $this->DAO->insertar("INSERT INTO menu (idPadre, titulo, privado, accion, orden) VALUES ($idPadre,'$titulo',$privado,'$accion',$orden)");
        }

        //Creamos los permisos de consulta, modificación y borrado.
        $this->DAO->insertar("INSERT INTO permisos (permiso) VALUES ('Consultar $titulo')");
        $this->DAO->insertar("INSERT INTO permisos (permiso) VALUES ('Editar $titulo')");
        $this->DAO->insertar("INSERT INTO permisos (permiso) VALUES ('Eliminar $titulo')");

        //Realizamos la unión entre el permiso de consultar y el menú, con el idPadre si lo tiene.
        $datos_menu = $this->DAO->consultar("SELECT idMenu, idPadre FROM menu WHERE titulo='$titulo'");
        $permisos = $this->DAO->consultar("SELECT idPermiso FROM permisos WHERE permiso='Consultar $titulo' OR permiso='Editar $titulo' OR permiso='Eliminar $titulo'");
        foreach($permisos as $permiso){
            $this->DAO->insertar("INSERT INTO permisos_menu (idMenu, idPermiso) VALUES (".$datos_menu[0]['idMenu'].",".$permiso['idPermiso'].")");
        }
    }

    public function comprobarRolUsuario($filtro=array()){
        extract($filtro);

        $resultados = $this->DAO->consultar("SELECT idRol FROM roles_usuarios WHERE id_Usuario=$id_Usuario AND idRol=$idRol");
        return [$resultados, $id_Usuario, $idRol];
    }

    public function asignacionRol($filtro=array()){
        extract($filtro);
        $resultados = $this->DAO->consultar("SELECT idRol FROM roles_usuarios WHERE id_Usuario=$id_Usuario AND idRol=$idRol");
        if(count($resultados)>0){
            $this->DAO->borrar("DELETE FROM roles_usuarios WHERE id_Usuario=$id_Usuario AND idRol=$idRol");
        }
        if(count($resultados)==0){
            $this->DAO->insertar("INSERT INTO roles_usuarios (id_Usuario, idRol) VALUES ($id_Usuario, $idRol)");
        }
    }

    public function guardarPermiso($filtro=array()){
        extract($filtro);
        $nombre_permiso=addslashes($nombre_permiso);
        if($form_idPermiso==0){
            $this->DAO->insertar("INSERT INTO permisos (permiso) VALUES ('$nombre_permiso')");
            $nueva_id = $this->DAO->consultar("SELECT idPermiso FROM permisos WHERE permiso='$nombre_permiso'");
            $this->DAO->insertar("INSERT INTO permisos_menu (idMenu, idPermiso) VALUES ($form_idMenu,".$nueva_id[0]['idPermiso'].")");
        }
        if($form_idPermiso!=0){
            $this->DAO->actualizar("UPDATE permisos SET permiso='$nombre_permiso' WHERE idPermiso=$form_idPermiso");
        }
    }

    public function guardarRol($filtro=array()){
        extract($filtro);
        $nombre_rol=addslashes($nombre_rol);
        if($form_idRol==0){
            $this->DAO->insertar("INSERT INTO roles (rol) VALUES ('$nombre_rol')");
        }
        if($form_idRol!=0){
            $this->DAO->actualizar("UPDATE roles SET rol='$nombre_rol' WHERE idRol=$form_idRol");
        }
    }

    public function eliminarRol($filtro=array()){
        extract($filtro);
        //Eliminamos las uniones del rol con el resto de tablas.
        $this->DAO->borrar("DELETE FROM roles_usuarios WHERE idRol=$idRol");
        $this->DAO->borrar("DELETE FROM permisos_roles WHERE idRol=$idRol");
        //Eliminamos el rol de la tabla de roles.
        $this->DAO->borrar("DELETE FROM roles WHERE idRol=$idRol");
    }
}
?>