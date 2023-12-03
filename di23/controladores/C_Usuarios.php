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
            $usuarios = $this->modelo->buscarUsuariosLogin($filtros);
            if (!empty($usuarios)) {
                $valido='S';
                $_SESSION['usuario']=$usuarios[0]['login'];
            } 
            return $valido;
        }

        public function getVistaUsuarios(){
            Vista::render('vistas/Usuarios/V_Usuarios.php');
        }

        public function getVistaInserciones(){
            Vista::render('vistas/Inserciones/V_Inserciones.php');
        }

        

        // public function buscarUsuarios($filtros=array()){
        //     $usuarios=$this->modelo->buscarUsuarios($filtros);
        //     //echo json_encode($usuarios);
        //     Vista::render('vistas/Usuarios/V_Usuarios_Listado.php', array('usuarios' => $usuarios));
        // }

        public function buscarUsuarios($filtros=array()){
            //Obtengo el numero de la pagina del GET
            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

            //Añadimos el numero de pagina a los filtros
            $filtros['pagina'] = $pagina;

            $usuarios=$this->modelo->buscarUsuarios($filtros);
            //echo json_encode($usuarios);
            Vista::render('vistas/Usuarios/V_Usuarios_Listado.php', array('usuarios' => $usuarios,'paginaActual' => $pagina));
        }

        public function buscarTelefono($filtros=array()){
            $usuarios=$this->modelo->buscarTelefono($filtros);
            //echo json_encode($usuarios);
            Vista::render('vistas/Usuarios/V_Usuarios_Listado.php', array('usuarios' => $usuarios));
        }

        public function buscarTelefonoyUsuario($filtros=array()){
            $usuarios=$this->modelo->buscarTelefonoyUsuario($filtros);
            //echo json_encode($usuarios);
            Vista::render('vistas/Usuarios/V_Usuarios_Listado.php', array('usuarios' => $usuarios));
        }

        public function insertarUsuario($filtros=array()){
            $usuarios=$this->modelo->insertarUsuario($filtros);
            //echo json_encode($usuarios);
            // Vista::render('vistas/Inserciones/V_Inserciones.php', array('usuarios' => $usuarios));
        }

        public function editarUsuario($filtros=array()){
            $usuarios=$this->modelo->editarUsuario($filtros);
            //echo json_encode($usuarios);
            Vista::render('vistas/Usuarios/V_Usuarios_Listado.php', array('usuarios' => $usuarios));
        }

    }
?>