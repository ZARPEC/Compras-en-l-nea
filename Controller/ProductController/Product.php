<?php

namespace Controller\ProductController;
use Model\ProductModel\ProductM; // referencia hacia la funcion de conexion de base de datos

class Product
{

    public function ShowProduct()
    {

        $CategoryGet = $_GET['category'];
        if (isset($_GET['SubCat'])) {
            $SubCategoryGet = $_GET['SubCat'];
        } else {
            $SubCategoryGet = null;

        }
        $Sub = ProductM::ShowProduct($CategoryGet, $SubCategoryGet, );
        return $Sub;
    }

}