<?php

namespace Controller\UserController;
use Model\UserModel\User;

class UserC
{

    public function UsuarioNuevo()
    {
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['contra'])) {

            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $usuario = $_POST['usuario'];
            $password = $_POST['contra'];

            $datos = array(
                'nombre' => $nombre,
                'apellido' => $apellido,
                'usuario' => $usuario,
                'password' => $password,

            );
            $respuesta = user::CrearCuenta($datos);

            return $respuesta ? "guardado" : "error";
        }
    }

    public function login()
    {
        if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
            $usuario = ($_POST['usuario']);
            $password = ($_POST['password']);

            $datos = array(
                'usuario' => $usuario,
            );
            $respuesta = user::login($datos);
            if (!empty($respuesta['USUARIO'])) {
                $resultado = $respuesta['PASSWORD'] == $password? true : false;

                if ($resultado) { //Hubo coincidencia
                    $_SESSION['usuario'] = $respuesta['USUARIO'];
                    
                    header("location: ?action=home");
                } else {
                    return "Error";
                }
            } else {
                return "ErrorUs";
            }
        }
    }
}

?>