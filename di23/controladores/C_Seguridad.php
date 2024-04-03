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

    public function buscarMenusCards($filtros = array())
    {
        list($menus, $permisos) = $this->modelo->buscarMenusCards($filtros);
        Vista::render('vistas/Menus/V_MttoMenus_Listado.php', array('menus' => $menus, 'permisos' => $permisos));
    }


    public function añadirPermisoMenu($filtros = array())
    {
        $menus = $this->modelo->añadirPermisoMenu($filtros);
    }

    public function borrarPermisoMenu($filtros = array())
    {
        $menus = $this->modelo->borrarPermisoMenu($filtros);
    }

    public function editarPermisoMenu($filtros = array())
    {
        $menus = $this->modelo->editarPermisoMenu($filtros);
    }

    public function borrarMenu($filtros = array())
    {
        $this->modelo->borrarMenu($filtros);
    }

    public function añadirMenus($filtros = array())
    {
        $this->modelo->añadirMenu($filtros);
    }

    public function añadirSubMenus($filtros = array())
    {
        $this->modelo->añadirSubMenus($filtros);
    }
}
