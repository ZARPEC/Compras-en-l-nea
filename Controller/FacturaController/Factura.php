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
}