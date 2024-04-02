<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';

class M_Seguridad extends Modelo
{
    public $DAO;
    public $SQLplantilla = "SELECT * FROM menus WHERE 1=1";
    public $OFFset = 0;

    public function __construct()
    {
        parent::__construct();
        $this->DAO = new DAO();
    }


    // public function buscarMenusCards($filtro = array())
    // {

    //     $usuario = '';
    //     $pass = '';

    //     extract($filtro);

    //     $SQL = "SELECT * FROM menus WHERE 1=1";

    //     if ($usuario != '' && $pass != '') {
    //         $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
    //         $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
    //         $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
    //     }

    //     $menus = $this->DAO->consultar($SQL);



    //     return $menus;
    // }

    public function buscarMenusCards($filtro = array())
    {
        $usuario = '';
        $pass = '';

        extract($filtro);

        $SQL = "SELECT * FROM menus WHERE 1=1";

        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracteres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }

        $menus = $this->DAO->consultar($SQL);

        $SQL2 = "SELECT * FROM menus_permisos WHERE 1=1";

        $permisos = $this->DAO->consultar($SQL2);

        return array($menus, $permisos); // Devolver un array con ambas variables
    }


    public function añadirPermisoMenu($filtro = array())
    {
        $usuario = '';
        $pass = '';
        $id_Menu = '';
        $permiso = '';

        extract($filtro);

        $SQL = "";

        //Esto es para que vea que estas logea
        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }

        $SQL .= "INSERT INTO `menus_permisos`(`id_Menu`, `permiso`) 
        VALUES ('$id_Menu','$permiso')";

        //echo $SQL;

        $this->DAO->insertar($SQL);
    }


    public function borrarPermisoMenu($filtro = array())
    {
        $usuario = '';
        $pass = '';
        $id_Menu = '';
        $permiso = '';

        extract($filtro);

        $SQL = "";

        //Esto es para que vea que estas logea
        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }

        $SQL = "DELETE FROM `menus_permisos` WHERE `id_Menu` = $id_Menu AND `permiso` = $permiso";


        $this->DAO->borrar($SQL);

        
    }
}
