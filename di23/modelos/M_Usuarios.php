<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Usuarios extends Modelo{
    public $DAO;

    public function __construct()
    {
        parent::__construct(); //ejecuta constructor padre
        $this->DAO = new DAO();
    }


    public function buscarUsuarios($filtro=array()){
        $b_texto='';
        $usuario=''; //login
        $pass='';
        extract($filtro);

        $SQL="SELECT * FROM usuarios WHERE 1=1";

        if ($usuario!='' && $pass!='') {
            $usuario=addslashes($usuario); //añade \ delante de caracterres especiales
            $pass=addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL.= " AND login = '$usuario' AND pass = MD5('$pass') ";
        } 
        
        if($b_texto!=''){
            $aTexto=explode(' ', $b_texto);
            $SQL.=" AND (1=2 ";
            foreach($aTexto as $palabra){
                $SQL.=" OR apellido_1 LIKE '%$palabra%' ";
                $SQL.=" OR apellido_2 LIKE '%$palabra%' ";
                $SQL.=" OR nombre LIKE '%$palabra%' ";
            }
            $SQL.=" ) ";
            //$SQL.=" AND apellido_1='".$b_texto."' ";
        }
        //echo $SQL;
        $usuarios= $this->DAO->consultar($SQL);
        return $usuarios;
    }

    public function buscarTelefono($filtro = array())
    {
        $usuario = ''; //login
        $pass = '';
        $b_telefono = '';
        extract($filtro);

        $SQL = "SELECT * FROM usuarios WHERE 1=1";

        //Esto es para que vea que estas logea
        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }

        //Este if de abajo es para buscar por usuarios

        if ($b_telefono != '') {

            $aTexto = explode(' ', $b_telefono); //jason del back

            foreach ($aTexto as $b_telefono) {

                $SQL = "SELECT * FROM usuarios
                WHERE movil IS NOT NULL AND movil LIKE '%$b_telefono%'
                ";
            }
            //echo $SQL; //esto nos muestra el sql que esta ejecutando
            $usuarios = $this->DAO->consultar($SQL);
            return $usuarios;

        }else{
            $SQL = "SELECT * FROM usuarios WHERE 1=1";

         
            $usuarios = $this->DAO->consultar($SQL);
            return $usuarios; 
        }
    }

    public function buscarTelefonoyUsuario($filtro = array())
    {
        $usuario = ''; //login
        $pass = '';
        $b_telefono = '';
        $b_texto='';
        extract($filtro);

        $SQL = "SELECT * FROM usuarios WHERE 1=1";

        //Esto es para que vea que estas logea
        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }










        //AQUIIIII








        //Este if de abajo es para buscar por usuarios

        if ($b_telefono != '' && $b_texto != '') {

            $aTexto = explode(' ', $b_telefono); //jason del back

            foreach ($aTexto as $b_telefono) {

                $SQL = "SELECT * FROM usuarios
                WHERE movil IS NOT NULL AND movil LIKE '%$b_telefono%'
                ";
            }
            //echo $SQL; //esto nos muestra el sql que esta ejecutando
            $usuarios = $this->DAO->consultar($SQL);
            return $usuarios;

        }else{
            $SQL = "SELECT * FROM usuarios WHERE 1=1";

         
            $usuarios = $this->DAO->consultar($SQL);
            return $usuarios; 
        }
    }
}
?>