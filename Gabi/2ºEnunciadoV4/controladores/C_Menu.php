<?php
    require_once 'controladores/Controlador.php';
    require_once 'vistas/Vista.php';
    require_once 'modelos/M_Menu.php';

    class C_Menu extends Controlador{
        private $modelo;
        public function __construct(){
            parent::__construct();
            $this->modelo = new M_Menu();
        }

        public function cargarMenu($usuario){
            $menu=$this->modelo->cargarMenu($usuario);
            Vista::render('vistas/V_Menu.php', array('menu' => $menu));
        }
    }
?>