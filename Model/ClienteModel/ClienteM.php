<?php
namespace Model\ClienteModel;
use Model\ConexionModel\Conexion;

class ClienteM
{


    public static function AddCliente($Nombre, $Apellido, $Telefono)
    {
        // Conexión a la base de datos
        $conn = Conexion::conectar();

        // Verifica la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos";
            return false;
        }

        // Consulta para obtener el ID máximo
        $sql_max_id = "SELECT NVL(MAX(idCliente), 0) AS max_id FROM Cliente";
        $result_max_id = oci_parse($conn, $sql_max_id);

        // Verifica el parseo de la consulta
        if (!$result_max_id) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta: " . $e['message'];
            return false;
        }

        // Ejecuta la consulta y verifica la ejecución
        if (!oci_execute($result_max_id)) {
            $e = oci_error($result_max_id);
            echo "Error al ejecutar la consulta: " . $e['message'];
            return false;
        }

        // Obtiene el valor máximo del ID
        $row = oci_fetch_assoc($result_max_id);
        $newId = $row['MAX_ID'] + 1;  // Le sumas 1 al ID máximo

        // Libera el recurso del result set de la consulta del máximo ID
        oci_free_statement($result_max_id);

        // Prepara la consulta de inserción
        $sql_insert = "INSERT INTO Cliente (idCliente, Nombre, Apellido, Telefono) 
                   VALUES (:idCliente, :Nombre, :Apellido, :Telefono)";
        $result_insert = oci_parse($conn, $sql_insert);

        // Verifica el parseo de la consulta
        if (!$result_insert) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta de inserción: " . $e['message'];
            return false;
        }

        // Vincula los parámetros, incluyendo el nuevo ID
        oci_bind_by_name($result_insert, ":idCliente", $newId);
        oci_bind_by_name($result_insert, ":Nombre", $Nombre);
        oci_bind_by_name($result_insert, ":Apellido", $Apellido);
        oci_bind_by_name($result_insert, ":Telefono", $Telefono);

        // Ejecuta la consulta de inserción y verifica la ejecución
        if (!oci_execute($result_insert, OCI_COMMIT_ON_SUCCESS)) {
            $e = oci_error($result_insert);
            echo "Error al ejecutar la consulta de inserción: " . $e['message'];
            return false;
        }

        // Cierra la conexión
        oci_free_statement($result_insert);
        oci_close($conn);

        return true;
    }

}