<?php

namespace Model\ProductModel;
use Model\ConexionModel\Conexion;


class ProductM
{
    public static function ShowProduct($Cat, $SubCat)
    {
        $conn = Conexion::conectar();

        // Verifica la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos";
            return [];
        }
        if (empty($SubCat)) {
            $sql = "SELECT 
                    p.idProducto,
                    p.NombreProd,
                    u.UNIDADMEDIDA,
                    p.CantMedida,
                    c.categoria,
                    s.Nsubcategoria,
                    p.precio,
                    p.Existencias
                FROM 
                    Producto p
                JOIN 
                    Subcategoria s ON p.FkSubCat = s.idSubcategoria
                JOIN 
                    UnidadMedida u ON p.FkUnidadMedida = u.IDUNIDADMEDIDA
                join CatProd c ON s.fkcategoria = c.idcatprod
                WHERE c.Categoria = :Cat
                ORDER BY p.NombreProd ASC";  // Se usa :subCat sin comillas para bind
        } else {
            $sql = "SELECT 
    p.idProducto,
    p.NombreProd,
    u.UNIDADMEDIDA,
    p.CantMedida,
    c.categoria,
    s.Nsubcategoria,
    sp.Nsubcategoria AS categoriaPadre,  -- Subcategoría padre
    p.precio,
    p.Existencias
FROM 
    Producto p
JOIN 
    Subcategoria s ON p.FkSubCat = s.idSubcategoria
JOIN 
    UnidadMedida u ON p.FkUnidadMedida = u.IDUNIDADMEDIDA
JOIN 
    CatProd c ON s.FkCategoria = c.idcatprod
LEFT JOIN 
    subcategoria sp ON s.SubCategoriaP = sp.idSubcategoria  -- Unir para obtener la subcategoría padre
WHERE 
    s.Nsubcategoria = :SubCat or sp.Nsubcategoria = :SubCat 
ORDER BY 
    p.NombreProd ASC";
        }
        $result = oci_parse($conn, $sql);

        // Verifica el parseo de la consulta
        if (!$result) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta: " . $e['message'];
            return [];
        }

        // Bind de la variable $subCat
        if (empty($SubCat)) {
            oci_bind_by_name($result, ':Cat', $Cat);
        } else {
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
            echo "No Existe categoria";
        }

        return $SubCategories;
    }

    public static function ShowItem($Item){
        $conn = Conexion::conectar();

        // Verifica la conexión
        if (!$conn) {
            echo "Error en la conexión a la base de datos";
            return [];
        }
            $sql = "SELECT 
                    p.idProducto,
                    p.NombreProd,
                    u.UNIDADMEDIDA,
                    p.CantMedida,
                    c.categoria,
                    s.Nsubcategoria,
                    p.precio,
                    p.Existencias
                FROM 
                    Producto p
                JOIN 
                    Subcategoria s ON p.FkSubCat = s.idSubcategoria
                JOIN 
                    UnidadMedida u ON p.FkUnidadMedida = u.IDUNIDADMEDIDA
                join CatProd c ON s.fkcategoria = c.idcatprod
                WHERE p.idproducto = :Item";  // Se usa :subCat sin comillas para bind
        
        $result = oci_parse($conn, $sql);

        // Verifica el parseo de la consulta
        if (!$result) {
            $e = oci_error($conn);
            echo "Error al parsear la consulta: " . $e['message'];
            return [];
        }

            oci_bind_by_name($result, ':Item', $Item);
        

        // Verifica la ejecución de la consulta
        if (!oci_execute($result)) {
            $e = oci_error($result);
            echo "Error al ejecutar la consulta: " . $e['message'];
            return [];
        }

        $Product = array();

        // Itera sobre los resultados y verifica que hay filas
        while (($row = oci_fetch_array($result, OCI_ASSOC)) !== false) {
            $Product[] = $row;
        }

        // Si no se obtienen resultados
        if (empty($Product)) {
            echo "No Existe categoria";
        }

        return $Product;
    }

}