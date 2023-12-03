<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
class M_Usuarios extends Modelo
{
    //Varibales para que accedan todas las funciones
    public $DAO;
    public $numListado = 10;
    public $SQLplantilla = "SELECT * FROM usuarios WHERE 1=1";
    public $OFFset = 0;

    public function __construct(){
        parent::__construct(); //ejecuta constructor padre
        $this->DAO = new DAO();
    }


    //Login
    public function buscarUsuariosLogin($filtro = array())
    {
        $b_texto = '';
        $usuario = ''; //login
        $pass = '';

        extract($filtro);

        $SQL = "SELECT * FROM usuarios WHERE 1=1";

        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }

        echo $SQL;
        $usuarios = $this->DAO->consultar($SQL);
        return $usuarios;
    }

    // public function buscarUsuarios($filtro = array())
    // {
    //     $b_texto = '';
    //     $usuario = ''; //login
    //     $pass = '';

    //     extract($filtro);

    //     $SQL = "SELECT * FROM usuarios WHERE 1=1";

    //     if ($usuario != '' && $pass != '') {
    //         $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
    //         $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
    //         $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
    //     }

    //     if ($b_texto != '') {
    //         $aTexto = explode(' ', $b_texto);
    //         $SQL .= " AND (1=2 ";
    //         foreach ($aTexto as $palabra) {
    //             $SQL .= " OR apellido_1 LIKE '%$palabra%' ";
    //             $SQL .= " OR apellido_2 LIKE '%$palabra%' ";
    //             $SQL .= " OR nombre LIKE '%$palabra%' ";
    //         }
    //         $SQL .= " )  LIMIT " . $this->numListado . " OFFSET " . $this->OFFset;
    //         //$SQL.=" AND apellido_1='".$b_texto."' ";
    //     }else{
    //         $SQL = "SELECT * FROM usuarios WHERE 1=1 LIMIT " . $this->numListado . " OFFSET " . $this->OFFset;
    //     }
    //     echo $SQL;
    //     $usuarios = $this->DAO->consultar($SQL);
    //     return $usuarios;
    // }


    public function buscarUsuarios($filtro = array())
    {
        $b_texto = '';
        $usuario = ''; //login
        $pass = '';
        //Con esto pillamos la pagina de los filtros
        $pagina = isset($filtro['pagina']) ? (int)$filtro['pagina'] : 1;

            echo " Primera pag es: " . $pagina . " ";

            $pagina = $pagina-1;

        // if ($pagina == null || $pagina == -1) {
        //     $pagina = 0;
        // }



        echo " Segunda pag pagina es " . $pagina . " ";
        extract($filtro);

        $SQL = "SELECT * FROM usuarios WHERE 1=1";

        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }

      if ($b_texto != '') {
          $aTexto = explode(' ', $b_texto);
          $SQL .= " AND (1=2 ";
          foreach ($aTexto as $palabra) {
              $SQL .= " OR apellido_1 LIKE '%$palabra%' ";
              $SQL .= " OR apellido_2 LIKE '%$palabra%' ";
              $SQL .= " OR nombre LIKE '%$palabra%' ";
          }
          $SQL .= " )";

          //$SQL.=" AND apellido_1='".$b_texto."' ";
      }else{
          $SQL = "SELECT * FROM usuarios WHERE 1=1";
      }
      $SQL .= " LIMIT $this->numListado OFFSET " . $pagina * 10;
        echo $SQL;
        $usuarios = $this->DAO->consultar($SQL);
        return $usuarios;
    }


    public function buscarTelefono($filtro = array()){
        $usuario = ''; //login
        $pass = '';
        $b_telefono = '';
        extract($filtro);

        $SQL = "SELECT * FROM usuarios WHERE 1=1 LIMIT " . $this->numListado;

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
                WHERE movil IS NOT NULL AND movil LIKE '%$b_telefono%' LIMIT " . $this->numListado;
            }
            echo $SQL; //esto nos muestra el sql que esta ejecutando
            $usuarios = $this->DAO->consultar($SQL);
            return $usuarios;
        } else {
            $SQL = "SELECT * FROM usuarios WHERE 1=1";


            $usuarios = $this->DAO->consultar($SQL); //this.DAO.consultar(SQL); es lo mismo
            return $usuarios;
        }
    }



    public function buscarTelefonoyUsuario($filtro = array()){
    $b_texto = '';
    $usuario = ''; // login
    $pass = '';
    $b_telefono = '';
    extract($filtro);

    $SQL = "SELECT * FROM usuarios WHERE 1=1";

    // Esto es para la autenticación
    if ($usuario != '' && $pass != '') {
        $usuario = addslashes($usuario);
        $pass = addslashes($pass);
        $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
    }

    // Este bloque es para buscar por texto (apellido_1, apellido_2, nombre)
    if ($b_texto != '') {
        $aTexto = explode(' ', $b_texto);
        $SQL .= " AND (1=2 ";
        foreach ($aTexto as $palabra) {
            $SQL .= " OR apellido_1 LIKE '%$palabra%' ";
            $SQL .= " OR apellido_2 LIKE '%$palabra%' ";
            $SQL .= " OR nombre LIKE '%$palabra%' ";
        }
        $SQL .= " )";
    }

    // Este bloque es para buscar por teléfono
    if ($b_telefono != '') {
        $aTelefonos = explode(' ', $b_telefono);
        foreach ($aTelefonos as $telefono) {
            $SQL .= " AND (movil IS NOT NULL AND movil LIKE '%$telefono%') LIMIT " . $this->numListado;;
        }
    }

    echo $SQL; // esto nos muestra el SQL que está ejecutando
    $usuarios = $this->DAO->consultar($SQL);
    return $usuarios;
}
       
    public function insertarUsuario($filtro = array()){
        $b_nombre = '';
        $b_apellido1 = '';
        $b_apellido2 = '';
        $b_sexo = '';
        $b_email = '';
        $b_movil = '';
        $b_user = '';
        $b_pass = '';
        $usuario = '';
        $pass = '';
        extract($filtro); //El filtro es un array y el extract saca los valores de dentro de ese array y los pone en las variables asociadas

        $SQL = "";

        //Esto es para que vea que estas logea
        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }


        if ($b_nombre != '' && $b_user != '' && $b_pass != '') {
            $SQL = "INSERT INTO `usuarios` (`nombre`, `apellido_1`, `apellido_2`, `sexo`, `fecha_Alta`, `mail`, `movil`, `login`, `pass`, `activo`) VALUES
            ('$b_nombre', '$b_apellido1', '$b_apellido2', '$b_sexo', '$b_email', '$b_email', '$b_movil', '$b_user', '$b_pass', 'S')";
            echo "El usuario $b_user se registró correctamente";
        } else {
            echo "No se realizó la inserción del usuario, por favor repitala.";
        }
        //echo $SQL;
        $usuarios = $this->DAO->insertar($SQL);
    }

    public function editarUsuario($filtro = array()){
        $b_id = '';
        $b_nombre = '';
        $b_apellido1 = '';
        $b_apellido2 = '';
        $b_sexo = '';
        $b_email = '';
        $b_movil = '';
        $b_user = '';
        $b_pass = '';
        $usuario = '';
        $pass = '';
        extract($filtro); //El filtro es un array y el extract saca los valores de dentro de ese array y los pone en las variables asociadas

        $SQL = "";

        //Esto es para que vea que estas logea
        if ($usuario != '' && $pass != '') {
            $usuario = addslashes($usuario); //añade \ delante de caracterres especiales
            $pass = addslashes($pass);        // como la ' , "" para que pierda funcionalidad
            $SQL .= " AND login = '$usuario' AND pass = MD5('$pass') ";
        }

        // && $b_user != '' && $b_pass != ''
        if ($b_nombre != '') {
            $SQL ="UPDATE `usuarios` SET 
              `nombre` = '$b_nombre',
              `apellido_1` = '$b_apellido1',
              `apellido_2` = '$b_apellido2',
              `sexo` = '$b_sexo',
              `mail` = '$b_email',
              `movil` = '$b_movil',
              `activo` = 'S'
            WHERE
              `id_usuario` = $b_id;";
            
            echo "El usuario $b_user se registró correctamente";
            echo $SQL;
        } else {
            echo "No se realizó la inserción del usuario, por favor repitala.";
        }
        //echo $SQL;
        $usuarios = $this->DAO->actualizar($SQL);

        $SQL = "SELECT * FROM usuarios WHERE 1=1";

        $usuarios = $this->DAO->consultar($SQL);
        return $usuarios;
    }



}
