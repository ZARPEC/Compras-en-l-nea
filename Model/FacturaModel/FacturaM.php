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

    public static function inDetallesFacturaM($detalles)
    {
        // Conexión a la base de datos
        $conn = Conexion::conectar();

        // Verifica la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos";
            return false;
        }

        // Obtener el ID máximo de la tabla Factura
        $idFactura = self::MaxIdFactura();  // Llamamos a la función que obtiene el ID máximo

        // Recorre cada detalle en el array de detalles para insertarlos
        foreach ($detalles as $detalle) {
            // Consulta para obtener el ID máximo de los detalles
            $sql_max_id = "SELECT NVL(MAX(idDetallesFactura), 0) AS max_id FROM DetallesFactura";
            $result_max_id = oci_parse($conn, $sql_max_id);

            if (!$result_max_id) {
                $e = oci_error($conn);
                echo "Error al parsear la consulta del ID máximo de detalles: " . $e['message'];
                return false;
            }

            // Ejecuta la consulta del máximo ID
            if (!oci_execute($result_max_id)) {
                $e = oci_error($result_max_id);
                echo "Error al ejecutar la consulta del ID máximo de detalles: " . $e['message'];
                return false;
            }

            // Obtiene el valor máximo del ID y le suma 1 para el nuevo registro
            $row = oci_fetch_assoc($result_max_id);
            $newIdDetalles = $row['MAX_ID'] + 1;

            // Libera el recurso del result set de la consulta del máximo ID
            oci_free_statement($result_max_id);

            // Prepara la consulta de inserción en la tabla DetallesFactura
            $sql_insert = "INSERT INTO DetallesFactura (idDetallesFactura, FkPruductoFac, Cantidad, FkFactura)
                       VALUES (:idDetallesFactura, :FkPruductoFac, :Cantidad, :FkFactura)";
            $result_insert = oci_parse($conn, $sql_insert);

            if (!$result_insert) {
                $e = oci_error($conn);
                echo "Error al parsear la consulta de inserción de detalles: " . $e['message'];
                return false;
            }

            // Vincula los parámetros, incluyendo el nuevo ID y el ID de la factura
            oci_bind_by_name($result_insert, ":idDetallesFactura", $newIdDetalles);
            oci_bind_by_name($result_insert, ":FkPruductoFac", $detalle['id']);
            oci_bind_by_name($result_insert, ":Cantidad", $detalle['cantidad']);
            oci_bind_by_name($result_insert, ":FkFactura", $idFactura);  // Aquí utilizamos el ID de la factura obtenido

            // Ejecuta la consulta de inserción y verifica la ejecución
            if (!oci_execute($result_insert, OCI_COMMIT_ON_SUCCESS)) {
                $e = oci_error($result_insert);
                echo "Error al ejecutar la consulta de inserción de detalles: " . $e['message'];
                return false;
            }

            // Libera el recurso del statement
            oci_free_statement($result_insert);
        }

        // Cierra la conexión
        oci_close($conn);

        return true;
    }


    public static function showFactura($idCliente, $idFactura)
    {
        $conn = Conexion::conectar();

        // Verifica la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos";
            return [];
        }

        // Definición de la consulta
        $sql = "
        SELECT 
            C.idCliente,                                    -- ID del cliente
            C.Nombre AS ClienteNombre,                      -- Nombre del cliente
            C.Apellido AS ClienteApellido,                  -- Apellido del cliente
            C.Telefono,                                     -- Teléfono del cliente
            C.Correo,                                       -- Correo electrónico del cliente
            F.idDatosFactura AS IdFactura,                  -- ID de la factura
            TRUNC(F.FechaFactura) AS FechaFactura,          -- Fecha de la factura sin hora
            DF.Cantidad,                                    -- Cantidad del producto
            P.NombreProd AS ProductoComprado,               -- Nombre del producto
            P.Precio AS PrecioProducto,                      -- Precio del producto
            (DF.Cantidad * P.Precio) AS Subtotal            -- Subtotal por producto
        FROM 
            Cliente C
        JOIN 
            Factura F ON C.idCliente = F.FkCliente
        JOIN 
            DetallesFactura DF ON F.idDatosFactura = DF.FkFactura
        JOIN 
            Producto P ON DF.FkPruductoFac = P.idProducto
        WHERE 
            C.idCliente = :idCliente OR F.idDatosFactura = :idFactura
        ORDER BY 
            F.idDatosFactura, P.NombreProd              -- Ordenar por ID de factura y nombre del producto
    ";

        $result = oci_parse($conn, $sql);

        // Verifica el parseo de la consulta
        if (!$result) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta: " . $e['message'];
            return [];
        }

        // Asocia el valor de :CategoryGet
        oci_bind_by_name($result, ':idCliente', $idCliente);
        oci_bind_by_name($result, ':idFactura', $idFactura);

        // Verifica la ejecución de la consulta
        if (!oci_execute($result)) {
            $e = oci_error($result);
            echo "Error al ejecutar la consulta: " . $e['message'];
            return [];
        }

        $InvoiceDetails = array();

        // Itera sobre los resultados y verifica que hay filas
        while (($row = oci_fetch_array($result, OCI_ASSOC)) !== false) {
            $InvoiceDetails[] = $row;
        }

        // Si no se obtienen resultados
        if (empty($InvoiceDetails)) {
            echo "No se obtuvieron resultados de la consulta";
        }

        return $InvoiceDetails;
    }

    public static function MaxIdFactura()
    {
        // Conexión a la base de datos
        $conn = Conexion::conectar();

        // Verifica la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos";
            return false;
        }

        // Consulta para obtener el ID máximo de la tabla Factura
        $sql_max_id = "SELECT NVL(MAX(idDatosFactura), 0) AS max_id FROM Factura";
        $result_max_id = oci_parse($conn, $sql_max_id);

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
        $maxId = $row['MAX_ID'];  // Valor del ID máximo

        // Libera el recurso del result set
        oci_free_statement($result_max_id);

        // Cierra la conexión
        oci_close($conn);

        return $maxId;
    }


}
