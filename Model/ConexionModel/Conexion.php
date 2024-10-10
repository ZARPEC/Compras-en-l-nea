<?php

namespace Model\ConexionModel;

class Conexion
{
    public static function conectar()
    {
        $conn =oci_connect('proyecto1','Proyecto.1','localhost/XE','AL32UTF8');

        return $conn;
    }
}
