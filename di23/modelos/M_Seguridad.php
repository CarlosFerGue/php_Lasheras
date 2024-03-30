<?php
    require_once 'modelos/Modelo.php';
    require_once 'modelos/DAO.php';

    class M_Seguridad extends Modelo{
        public $DAO;
        public $SQLplantilla = "SELECT * FROM menus WHERE 1=1";
        public $OFFset = 0;

        public function __construct(){
            parent::__construct();
            $this->DAO = new DAO();
        }


        public function buscarMenus($filtro = array()){

            $usuario = '';
            $pass = '';

            extract($filtro);

            $SQL = "SELECT * FROM menus WHERE 1=1";

            if ($usuario != '' && $pass != '') {
                $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
                $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
                $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
            }

            $menus = $this->DAO->consultar($SQL);

            return $menus;
        }
    }





?>