<?php
    require_once 'modelos/Modelo.php';
    require_once 'modelos/DAO.php';

    class M_Menus extends Modelo{
        public $DAO;
        public $SQLplantilla = "SELECT * FROM menus WHERE 1=1";
        public $OFFset = 0;

        public function __construct(){
            parent::__construct();
            $this->DAO = new DAO();
        }


        public function 
    }





?>