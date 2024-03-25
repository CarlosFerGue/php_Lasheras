<?php
    require_once 'controladores/Controlador.php';
    require_once 'vistas/Vista.php';
    require_once 'modelos/M_Usuarios.php';

    class C_Usuarios extends Controlador{
        private $modelo;
        public function __construct(){
            parent::__construct();
            $this->modelo = new M_Usuarios();
        }

        public function validarUsuario($filtros){
            $valido='N';
            $usuario = $this->modelo->buscarUsuario($filtros);
            if (!empty($usuario)) {
                $valido='S';
                $_SESSION['usuario']=$usuario[0]['login'];
                $_SESSION['permisos'] = $this->modelo->buscarPermisos($usuario[0]['login']);
            }
            return $valido;
        }

        public function getVistaUsuarios(){
            Vista::render('vistas/Usuarios/V_Usuarios.php');
        }
        
        public function buscarUsuarios($filtros=array()){
            $resultados=$this->modelo->buscarUsuarios($filtros);
            Vista::render('vistas/V_Paginado.php', array('resultados' => $resultados));
        }

        public function guardarUsuario($parametros=array()){
            $this->modelo->guardarUsuario($parametros);
        }
    }
?>