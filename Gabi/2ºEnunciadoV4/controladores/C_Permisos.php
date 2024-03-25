<?php
    require_once 'controladores/Controlador.php';
    require_once 'vistas/Vista.php';
    require_once 'modelos/M_Permisos.php';

    class C_Permisos extends Controlador{
        private $modelo;
        public function __construct(){
            parent::__construct();
            $this->modelo = new M_Permisos();
        }
        //Mostramos el formulario de menús y permisos.
        public function getVistaPermisos(){
            $resultados=$this->modelo->buscarUsuariosRoles();
            Vista::render('vistas/Permisos/V_Permisos.php', array('resultados' => $resultados));
            //Vista::render('vistas/Permisos/V_Permisos.php');
        }
        //Cargamos 
        public function buscarMenus($filtros=array()){
            $resultados=$this->modelo->buscarMenus($filtros);
            Vista::render('vistas/Permisos/V_Menus.php', array('resultados' => $resultados));
        }
        public function borrarMenu($filtros=array()){
            $this->modelo->borrarMenu($filtros);
        }
        public function actualizarMenu($filtros=array()){
            $this->modelo->actualizarMenu($filtros);
        }
        public function anadirMenu($filtros=array()){
            $this->modelo->anadirMenu($filtros);
        }

        public function eliminarPermiso($filtros=array()){
            $this->modelo->eliminarPermiso($filtros);
        }

        public function asignarPermiso($filtros=array()){
            $this->modelo->asignarPermiso($filtros);
        }

        public function comprobarRolUsuario($filtros=array()){
            $resultados = $this->modelo->comprobarRolUsuario($filtros);
            Vista::render('vistas/Permisos/V_AsignarRol.php', array('resultados' => $resultados));
        }

        public function asignacionRol($filtros=array()){
            $this->modelo->asignacionRol($filtros);
        }

        public function guardarPermiso($filtros=array()){
            $this->modelo->guardarPermiso($filtros);
        }

        public function guardarRol($filtros=array()){
            $this->modelo->guardarRol($filtros);
        }

        public function eliminarRol($filtros=array()){
            $this->modelo->eliminarRol($filtros);
        }
    }
?>