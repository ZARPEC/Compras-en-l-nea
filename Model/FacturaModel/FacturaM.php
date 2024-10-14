<?php
namespace Model\FacturaModel;
use Model\ConexionModel\Conexion;

class FacturaM
{
    public static function inFacturaM($FkMetodoPago)
    {
        // Conexión a la base de datos
        $conn = Conexion::conectar();

        // Verifica la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos";
            return false;
        }

        // Consulta para obtener el ID máximo
        $sql_max_id = "SELECT NVL(MAX(idDatosFactura), 0) AS max_id FROM Factura";
        $result_max_id = oci_parse($conn, $sql_max_id);

        $sql_max_idCliente = "SELECT NVL(MAX(idCliente), 0) AS max_idCliente FROM Cliente";
        $result_max_idCliente = oci_parse($conn, $sql_max_idCliente);

        // Verifica el parseo de la consulta
        if (!$result_max_id && !$result_max_idCliente) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta: " . $e['message'];
            return false;
        }

        // Ejecuta la consulta y verifica la ejecución
        if (!oci_execute($result_max_id)) {
            $e = oci_error($result_max_id);
            echo "Error al ejecutar la consulta para el ID máximo: " . $e['message'];
            return false;
        }

        if (!oci_execute($result_max_idCliente)) {
            $e = oci_error($result_max_idCliente);
            echo "Error al ejecutar la consulta para el ID máximo de cliente: " . $e['message'];
            return false;
        }

        // Obtiene el valor máximo del ID
        $row = oci_fetch_assoc($result_max_id);
        $newId = $row['MAX_ID'] + 1;  // Le sumas 1 al ID máximo
        $row2 = oci_fetch_assoc($result_max_idCliente);
        $newIdCliente = $row2['MAX_IDCLIENTE'];

        // Libera el recurso del result set de la consulta del máximo ID
        oci_free_statement($result_max_id);
        oci_free_statement($result_max_idCliente);


        // Prepara la consulta de inserción
        $sql_insert = "INSERT INTO Factura (idDatosFactura, FkCliente, FechaFactura, FkMetodoPago) 
                       VALUES (:idDatosFactura, :FkCliente, SYSTIMESTAMP, :FkMetodoPago)";
        $result_insert = oci_parse($conn, $sql_insert);

        // Verifica el parseo de la consulta
        if (!$result_insert) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta de inserción: " . $e['message'];
            return false;
        }

        // Vincula los parámetros, incluyendo el nuevo ID
        oci_bind_by_name($result_insert, ":idDatosFactura", $newId);
        oci_bind_by_name($result_insert, ":FkCliente", $newIdCliente);
        oci_bind_by_name($result_insert, ":FkMetodoPago", $FkMetodoPago);

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
