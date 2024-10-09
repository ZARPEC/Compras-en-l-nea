<?php

use Controller\categoryController\CategoryC;
$controller = new CategoryC();  // Asumiendo que el nombre de la clase es CategoryC
$categories = $controller->showCategoryC();

if (!empty($categories)) {
    foreach ($categories as $category) {
        echo $category['CATEGORIA'] . '<br>';  // Muestra la categoría si existe
    }
} else {
    echo "No se encontraron categorías.";
}
?>