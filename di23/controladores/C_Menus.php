<?php 
    require_once 'controladores/Controlador.php';
    require_once 'vistas/Vista.php';
    require_once 'modelos/M_Menus.php';

    class C_Menus extends Controlador{
        private $modelo;
        public function __construct(){
            parent::__construct();
            $this->modelo = new M_Menus();
        }

        public function getMenuBD(){
            Vista::render('vistas/Menus/V_Menus');
        }
        

        public function getVistaMenus($filtros=array()){
            $menus=$this->modelo->buscarMenus($filtros);

            Vista::render('vistas/Menus/V_Menus.php', array('menus' => $menus));
        }
    }
?>