<?php
require_once 'controladores/Controlador.php';
require_once 'vistas/Vista.php';
require_once 'modelos/M_Seguridad.php';

class C_Seguridad extends Controlador
{
    private $modelo;

    public function __construct()
    {
        parent::__construct();
        $this->modelo = new M_Seguridad();
    }
    //Renderizar la vista de los menus para buscar debajo de la barra superior
    public function getVistaSeguridad()
    {
        Vista::render('vistas/Menus/V_MttoMenus.php');
    }

    //Con esto buscamos todos los menus cada uno en su card
    public function buscarMenusCards($filtros=array()){
        $menus=$this->modelo->buscarMenusCards($filtros);
        //echo json_encode($menus);
        Vista::render('vistas/Menus/V_MttoMenus_Listado.php', array('menus' => $menus));
    }

    public function añadirPermisoMenu($filtros=array()){
        $menus=$this->modelo->añadirPermisoMenu($filtros); 
    }
}
