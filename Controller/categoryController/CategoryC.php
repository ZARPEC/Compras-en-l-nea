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

        $Sub = Category::ShowSubCategory();
        return $Sub;
    }
}
?>