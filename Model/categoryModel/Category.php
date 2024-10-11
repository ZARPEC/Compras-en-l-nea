<?php

namespace Model\categoryModel;
use Model\ConexionModel\Conexion;


class Category
{
    public static function ShowCategory()
    {
        $conn = Conexion::conectar();

        // Verifica la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos";
            return [];
        }

        $sql = "SELECT * FROM catProd ORDER BY CATEGORIA ASC";
        $result = oci_parse($conn, $sql);

        // Verifica el parseo de la consulta
        if (!$result) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta: " . $e['message'];
            return [];
        }

        // Verifica la ejecución de la consulta
        if (!oci_execute($result)) {
            $e = oci_error($result);
            echo "Error al ejecutar la consulta: " . $e['message'];
            return [];
        }

        $categories = array();

        // Itera sobre los resultados y verifica que hay filas
        while (($row = oci_fetch_array($result, OCI_ASSOC)) !== false) {
            $categories[] = $row;
        }

        // Si no se obtienen resultados
        if (empty($categories)) {
            echo "No se obtuvieron resultados de la consulta";
        }

        return $categories;

    }

    public static function ShowSubCategory($CategoryGet, $SubCat)
    {
        $conn = Conexion::conectar();

        // Verifica la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos";
            return [];
        }
        if (empty($SubCat)) {
            $sql = "SELECT s.idSubcategoria, s.Nsubcategoria, c.Categoria
            FROM Subcategoria s
            JOIN CatProd c ON s.fkCategoria = c.idCatProd
            WHERE c.Categoria = :CategoryGet
            AND (s.SubCategoriaP IS NULL OR s.SubCategoriaP = 0)
            "
            ;  // Se usa :subCat sin comillas para bind
        }else{
            $sql = "SELECT s.idSubcategoria, s.Nsubcategoria, c.Categoria
            FROM Subcategoria s
            JOIN CatProd c ON s.fkCategoria = c.idCatProd
            WHERE s.SubCategoriaP IN (
            SELECT idSubcategoria 
            FROM Subcategoria 
            WHERE Nsubcategoria = :SubCat
  )
            ";
        }
        $result = oci_parse($conn, $sql);

        // Verifica el parseo de la consulta
        if (!$result) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta: " . $e['message'];
            return [];
        }

        if (empty($SubCat)) {
        oci_bind_by_name($result, ':CategoryGet', $CategoryGet);
        }else {
            oci_bind_by_name($result, ':SubCat', $SubCat);
        }

        // Verifica la ejecución de la consulta
        if (!oci_execute($result)) {
            $e = oci_error($result);
            echo "Error al ejecutar la consulta: " . $e['message'];
            return [];
        }

        $SubCategories = array();

        // Itera sobre los resultados y verifica que hay filas
        while (($row = oci_fetch_array($result, OCI_ASSOC)) !== false) {
            $SubCategories[] = $row;
        }

        // Si no se obtienen resultados
        if (empty($SubCategories)) {
            echo "No se obtuvieron resultados de la consulta";
        }

        return $SubCategories;
    }


}
