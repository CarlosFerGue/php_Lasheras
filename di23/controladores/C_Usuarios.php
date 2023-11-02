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
            //$usuario='';
            //$pass='srfdvsvwrt';
            //extract($datos);
            //$valido='N';
            /* if($usuario=='Pablo' && $pass=='1234'){
                $_SESSION['usuario']=$usuario;
                $valido='S';  
                header('Location: index.php'); 
                echo $valido;
            } */
            $valido='N';
            $usuarios = $this->modelo->buscarUsuarios($filtros);
            if (!empty($usuarios)) {
                $valido='S';
                $_SESSION['usuario']=$usuarios[0]['login'];
            } 
            return $valido;
        }

        public function getVistaUsuarios(){
            Vista::render('vistas/Usuarios/V_Usuarios.php');
        }
        public function buscarUsuarios($filtros=array()){
            $usuarios=$this->modelo->buscarUsuarios($filtros);
            //echo json_encode($usuarios);
            Vista::render('vistas/Usuarios/V_Usuarios_Listado.php', array('usuarios' => $usuarios));
        }

    }
?>