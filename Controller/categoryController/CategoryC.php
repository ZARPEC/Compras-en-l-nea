<?php

namespace Controller\categoryController;
use Model\categoryModel\Category; // referencia hacia la funcion de conexion de base de datos

class CategoryC
{
    public function showCategoryC()
    {

        $Cat = Category::ShowCategory();
        return $Cat;
    }

    public function showSubCategoryC()
    {
        $CategoryGet = $_GET['category'];
        if (isset($_GET['SubCat'])) {
            $SubCategoryGet = $_GET['SubCat'];
        } else {
            $SubCategoryGet = null;

        }
        $Sub = Category::ShowSubCategory($CategoryGet, $SubCategoryGet);
        return $Sub;
    }
}
?>