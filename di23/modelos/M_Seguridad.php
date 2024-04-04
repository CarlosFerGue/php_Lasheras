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

        $SQL3 = "SELECT * FROM roles WHERE 1=1";

        $roles = $this->DAO->consultar($SQL3);

        $SQL4 = "SELECT * FROM usuarios WHERE 1=1";

        $usuarios = $this->DAO->consultar($SQL4);

        return array($menus, $permisos, $roles, $usuarios); // Devolver un array con ambas variables
    }


    public function añadirPermisoMenu($filtro = array())
    {
        $usuario = '';
        $pass = '';
        $id_Menu = '';
        $permiso = '';

        extract($filtro);

        // Verificar si ya existe un registro con el mismo id_Menu y permiso
        $SQL = "SELECT COUNT(*) as count FROM `menus_permisos` WHERE `id_Menu` = '$id_Menu' AND `permiso` = '$permiso'";
        $resultado = $this->DAO->consultar($SQL);

        // Extraer el número de registros encontrados
        $numRegistros = $resultado[0]['count'];

        // Si no hay registros con el mismo id_Menu y permiso, procedemos a insertar
        if ($numRegistros == 0) {
            $SQL = "";

            // Esto es para que vea que estas logeado
            if ($usuario != '' && $pass != '') {
                $usuario = addslashes($usuario); // añade \ delante de caracteres especiales
                $pass = addslashes($pass);       // como la ' , "" para que pierda funcionalidad
                $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
            }

            // Construir la consulta de inserción
            $SQL .= "INSERT INTO `menus_permisos`(`id_Menu`, `permiso`) 
        VALUES ('$id_Menu','$permiso')";

            // Ejecutar la consulta de inserción
            $this->DAO->insertar($SQL);
        } else {
            // Si ya existe un registro con el mismo id_Menu y permiso, puedes manejarlo de alguna manera, por ejemplo, lanzando una excepción o devolviendo un mensaje de error.
            throw new Exception("Ya existe un permiso para el menú con ID $id_Menu y permiso $permiso.");
        }
    }



    public function borrarPermisoMenu($filtro = array())
    {
        $id_Menu = '';
        $permisos = '';

        extract($filtro);

        $SQL = "";

        // Eliminar el permiso del menú especificado
        $SQL .= "DELETE FROM `menus_permisos` WHERE `id_Menu` = '$id_Menu' AND `permiso` = '$permisos'";

        $this->DAO->borrar($SQL);
    }

    public function editarPermisoMenu($filtro = array())
    {
        $id_Menu = '';
        $permisos = '';
        $permisoNuevo = '';

        extract($filtro);

        // Eliminar el permiso del menú especificado
        //"DELETE FROM `menus_permisos` WHERE `id_Menu` = '$id_Menu' AND `permiso` = '$permisos'";
        $SQL = "UPDATE `menus_permisos` SET `permiso`='$permisoNuevo' WHERE `id_Menu` = '$id_Menu' AND `permiso` = '$permisos'";

        $this->DAO->actualizar($SQL);
    }


    public function borrarMenu($filtro = array())
    {
        $id_Menu = '';

        extract($filtro);

        // Eliminar los permisos asociados al menú
        $SQL_permisos = "DELETE FROM `menus_permisos` WHERE `id_Menu` = '$id_Menu'";
        $this->DAO->borrar($SQL_permisos);

        // Eliminar el menú especificado
        $SQL_menu = "DELETE FROM `menus` WHERE `id_Menu` = '$id_Menu'";
        $this->DAO->borrar($SQL_menu);
    }

    public function añadirMenu($filtro = array())
    {
        $posicion = '';
        $nombreMenu = '';

        extract($filtro);

        if ($nombreMenu != null) {
            // Actualizar las posiciones de los menús existentes que estén por encima de la posición proporcionada
            $actualizarSQL = "UPDATE `menus` SET `posicion` = `posicion` + 1 WHERE `posicion` >= $posicion";
            $this->DAO->insertar($actualizarSQL);

            // Obtener el próximo valor de id_Menu
            $consultaIDSQL = "SELECT MAX(`id_Menu`) AS max_id FROM `menus`";
            $resultadoConsulta = $this->DAO->consultar($consultaIDSQL);
            $proximoID = $resultadoConsulta[0]['max_id'] + 1;

            // Insertar el nuevo menú con el próximo valor de id_Menu y la posición proporcionada
            $insertarMenuSQL = "INSERT INTO `menus`(`id_Menu`, `nombre`, `controlador`, `model`, `id_Padre`, `orden`, `privado`, `posicion`) 
                            VALUES ('$proximoID', '$nombreMenu', '', '', '', '', '','$posicion')";
            $this->DAO->insertar($insertarMenuSQL);

            // Insertar permisos para el nuevo menú en la tabla menus_permisos
            $insertarPermisosSQL = "INSERT INTO `menus_permisos`(`id_Menu`, `permiso`) 
                                VALUES ('$proximoID', 'Consultar $nombreMenu'),
                                       ('$proximoID', 'Editar $nombreMenu'),
                                       ('$proximoID', 'Crear $nombreMenu'),
                                       ('$proximoID', 'Modificar $nombreMenu'),
                                       ('$proximoID', 'Cambiar $nombreMenu')";
            $this->DAO->insertar($insertarPermisosSQL);
        }
    }

    public function añadirSubMenus($filtro = array())
    {
        $posicion = '';
        $nombreMenu = '';
        $id_Menu = '';

        extract($filtro);

        if ($nombreMenu != null) {
            // Actualizar las posiciones de los menús existentes que estén por encima de la posición proporcionada
            $actualizarSQL = "UPDATE `menus` SET `posicion` = `posicion` + 1 WHERE `posicion` >= $posicion";
            $this->DAO->insertar($actualizarSQL);

            // Obtener el próximo valor de id_Menu
            $consultaIDSQL = "SELECT MAX(`id_Menu`) AS max_id FROM `menus`";
            $resultadoConsulta = $this->DAO->consultar($consultaIDSQL);
            $proximoID = $resultadoConsulta[0]['max_id'] + 1;

            // Obtener el id del orden del padre
            $consultaOrdenPadreSQL = "SELECT `orden` FROM `menus` WHERE `id_Menu` = $id_Menu";
            $resultadoConsulta = $this->DAO->consultar($consultaOrdenPadreSQL);
            $ordenPadre = $resultadoConsulta[0]['orden'];

            // Insertar el nuevo menú con el próximo valor de id_Menu y la posición proporcionada
            $insertarMenuSQL = "INSERT INTO `menus`(`id_Menu`, `nombre`, `controlador`, `model`, `id_Padre`, `orden`, `privado`, `posicion`) 
                            VALUES ('$proximoID', '$nombreMenu', '', '', '$id_Menu', '$ordenPadre', '','$posicion')";
            $this->DAO->insertar($insertarMenuSQL);

            // Insertar permisos para el nuevo menú en la tabla menus_permisos
            $insertarPermisosSQL = "INSERT INTO `menus_permisos`(`id_Menu`, `permiso`) 
                                VALUES ('$proximoID', 'Consultar $nombreMenu'),
                                       ('$proximoID', 'Editar $nombreMenu'),
                                       ('$proximoID', 'Crear $nombreMenu'),
                                       ('$proximoID', 'Modificar $nombreMenu'),
                                       ('$proximoID', 'Cambiar $nombreMenu')";
            $this->DAO->insertar($insertarPermisosSQL);
        }
    }

    public function guardarNombre($filtro = array())
    {
        $id_Menu = '';
        $nombreActual = '';
        $nuevoNombre = '';

        extract($filtro);

        $SQL = "UPDATE `menus` SET `nombre`='$nuevoNombre' WHERE `id_Menu` = '$id_Menu' AND `nombre` = '$nombreActual'";

        $this->DAO->actualizar($SQL);
    }

    public function borrarRol($filtro = array())
    {
        $id_Rol = '';
        $nombre = '';

        extract($filtro);

        $SQL = "DELETE FROM `roles` WHERE `Id` = '$id_Rol' AND `Nombre` = '$nombre'";

        $this->DAO->borrar($SQL);
    }
}
