<?php
ini_set('display_errors', 'Off');
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Menu extends Modelo{
    public $DAO;

    public function __construct(){
        parent::__construct(); //ejecuta constructor padre
        $this->DAO = new DAO();
    }

    public function cargarMenu($usuario){
        $SQL = "";
        if($usuario == NULL){
            $SQL="SELECT * FROM menu WHERE privado = 0;";
        }
        else{
            $SQL="SELECT M.idMenu, M.titulo, M.idPadre, M.privado, M.orden, M.accion
                FROM usuarios U, permisos_usuarios PU, permisos P, menu M, permisos_menu PM, roles R, permisos_roles PR, roles_usuarios RU
                WHERE (U.login = '$usuario'
                		AND U.id_Usuario = RU.id_Usuario
                		AND RU.idRol = R.idRol
                		AND R.idRol = PR.idRol
                        AND PR.idPermiso = P.idPermiso
                        AND P.idPermiso = PM.idPermiso
                        AND PM.idMenu = M.idMenu)
                	OR (U.login = '$usuario'
                		AND U.id_Usuario = PU.id_Usuario
                		AND PU.idPermiso = P.idPermiso
                		AND P.idPermiso = PM.idPermiso
                        AND PM.idMenu = M.idMenu)
                	OR M.privado = 0
                GROUP BY M.idMenu
                ORDER BY M.orden;";

        }

        $menu= $this->DAO->consultar($SQL);
        return $menu;
    }
}
?>