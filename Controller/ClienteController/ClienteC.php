<?php

namespace Controller\ClienteController;
use Model\ClienteModel\ClienteM; // referencia hacia la funcion de conexion de base de datos

class ClienteC
{
    //
    public function inCliente($nombre,$apellido,$telefono)
    {

        $Cat = ClienteM::AddCliente($nombre,$apellido,$telefono);
        return $Cat;
    }

}
?>