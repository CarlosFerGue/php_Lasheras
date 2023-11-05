<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Usuarios extends Modelo
{
    public $DAO;

    public function __construct()
    {
        parent::__construct(); //ejecuta constructor padre
        $this->DAO = new DAO();
    }


    public function buscarUsuarios($filtro = array())
    {
        $b_texto = '';
        $usuario = ''; //login
        $pass = '';
        extract($filtro);

        // $SQL = "SELECT * FROM usuarios WHERE 1=1";

        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }

        //Este if de abajo es para buscar por usuarios

        if ($b_texto != '') {
            $SQL = "SELECT * FROM usuarios WHERE 1=1";
            $aTexto = explode(' ', $b_texto);
            $SQL .= " AND (1=2 ";
            foreach ($aTexto as $palabra) {
                $SQL .= " OR apellido_1 LIKE '%$palabra%' ";
                $SQL .= " OR apellido_2 LIKE '%$palabra%' ";
                $SQL .= " OR nombre LIKE '%$palabra%' ";
            }
            $SQL .= " ) ";
            $SQL.=" AND apellido_1='".$b_texto."' ";
            
        }
        echo $SQL; //esto nos muestra el sql que esta ejecutando
        $usuarios = $this->DAO->consultar($SQL);
        return $usuarios;
    }





    public function buscarTelefono($filtro = array())
    {
        $b_texto = '';
        $usuario = ''; //login
        $pass = '';
        $telefono = '';
        extract($filtro);

        $SQL = "SELECT * FROM usuarios WHERE 1=1";

        //Esto es para que vea que estas logea
        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }

        //Este if de abajo es para buscar por usuarios

        if ($b_texto != '') {

            $aTexto = explode(' ', $b_texto); //jason del back

            foreach ($aTexto as $telefono) {

                $SQL = "SELECT * FROM usuarios
                WHERE movil IS NOT NULL AND movil LIKE '%$telefono%'
                ";
            }
            echo $SQL; //esto nos muestra el sql que esta ejecutando
            $usuarios = $this->DAO->consultar($SQL);
            return $usuarios;
        }
    }
}
