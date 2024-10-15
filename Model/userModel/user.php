<?php
namespace Model\UserModel;
use Model\ConexionModel\Conexion;

class User
{

    public static function CrearCuenta($datos)
    {
        // Conectar a la base de datos
        $conn = Conexion::conectar();

        // Verifica si la conexión fue exitosa
        if (!$conn) {
            echo "Error en la conexión a la base de datos.";
            return false;
        }

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO Usuario (idUsuario, \"User\", \"Password\") 
                VALUES (:idUsuario, :usuario, :password)";

        // Preparar la sentencia OCI8
        $stmt = oci_parse($conn, $sql);

        // Verifica si el parseo de la consulta fue exitoso
        if (!$stmt) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta: " . $e['message'];
            return false;
        }


        $idUsuario = self::getNextUserId();


        // Asociar los valores a los parámetros de la consulta
        oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
        oci_bind_by_name($stmt, ":usuario", $datos['usuario']);
        oci_bind_by_name($stmt, ":password", $datos['password']);

        // Ejecutar la sentencia
        $result = oci_execute($stmt);

        // Verificar si la ejecución fue exitosa
        if (!$result) {
            $e = oci_error($stmt);
            echo "Error al ejecutar la consulta: " . $e['message'];
            return false;
        }

        // Cerrar la conexión
        oci_free_statement($stmt);
        oci_close($conn);

        return true; // Retornar true si se guardaron los datos correctamente
    }

    public static function login($datos)
    {
        // Conectar a la base de datos
        $conn = Conexion::conectar();

        // Verificar la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos.";
            return false;
        }

        // Consulta SQL para obtener el usuario
        $sql = "SELECT idUsuario, \"User\" AS usuario, \"Password\" AS password
                FROM Usuario 
                WHERE \"User\" = :usuario";

        // Preparar la sentencia
        $stmt = oci_parse($conn, $sql);

        // Verificar si el parseo fue exitoso
        if (!$stmt) {
            $e = oci_error($conn);
            echo "Error al preparar la consulta: " . $e['message'];
            return false;
        }

        // Asociar el parámetro de usuario
        oci_bind_by_name($stmt, ':usuario', $datos['usuario']);

        // Ejecutar la consulta
        oci_execute($stmt);

        // Obtener los resultados
        $usuario = oci_fetch_array($stmt, OCI_ASSOC);

        // Verificar si se encontró el usuario
        if ($usuario) {
            // Retornar los datos del usuario
            return $usuario;
        } else {
            // Si no existe el usuario, retornar falso
            return false;
        }
    }


    private static function getNextUserId()
    {
        // Lógica para obtener el próximo ID disponible
        $conn = Conexion::conectar();
        $sql = "SELECT MAX(idUsuario) AS max_id FROM Usuario";
        $stmt = oci_parse($conn, $sql);
        oci_execute($stmt);

        $row = oci_fetch_array($stmt, OCI_ASSOC);
        $maxId = $row ? $row['MAX_ID'] : 0;

        oci_free_statement($stmt);
        oci_close($conn);

        return $maxId + 1;
    }

}

?>