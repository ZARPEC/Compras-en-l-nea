<?php

namespace Controller\FacturaController;

use Model\FacturaModel\FacturaM; // referencia hacia la funcion de conexion de base de datos

class Factura
{

    public function inFactura($FkMetodoPago)
    {
        $Cat = FacturaM::inFacturaM($FkMetodoPago);
        return $Cat;
    }

    public function indetalles($productos)
    {
        $Cat = FacturaM::inDetallesFacturaM($productos);
        return $Cat;
    }

    public function showFactura()
    {
        if (isset($_SESSION['idCliente'])) {
            $idCliente = $_SESSION['idCliente'];
        } else if (isset($_POST['idFactura'])) {
            $idCliente = $_POST['idFactura'];
        } else {
            $idFactura = FacturaM::MaxIdFactura();
            $idCliente = 0;
        }

        $fact = FacturaM::showFactura($idCliente, $idFactura);
        return $fact;
    }
}
/*
SELECT 
    C.idCliente,                                    -- ID del cliente
    C.Nombre AS ClienteNombre,                      -- Nombre del cliente
    C.Apellido AS ClienteApellido,                  -- Apellido del cliente
    C.Telefono,                                     -- Teléfono del cliente
    C.Correo,                                       -- Correo electrónico del cliente
    F.idDatosFactura AS IdFactura,                  -- ID de la factura
    DF.Cantidad,                                    -- Cantidad del producto
    P.NombreProd AS ProductoComprado,               -- Nombre del producto
    P.Precio AS PrecioProducto,                      -- Precio del producto
    (DF.Cantidad * P.Precio) AS Subtotal            -- Subtotal por producto
FROM 
    Cliente C
JOIN 
    Factura F ON C.idCliente = F.FkCliente                     -- Relación con Factura
JOIN 
    DetallesFactura DF ON F.idDatosFactura = DF.FkFactura       -- Relación con DetallesFactura
JOIN 
    Producto P ON DF.FkPruductoFac = P.idProducto               -- Relación con Producto
ORDER BY 
    C.idCliente, F.idDatosFactura, P.NombreProd;               -- Ordenar por ID del cliente, ID de factura y nombre del producto
*/