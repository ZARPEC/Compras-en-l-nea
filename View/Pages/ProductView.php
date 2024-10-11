<?php
use Controller\ProductController\Product;
$controllerProd = new Product();
$produ = $controllerProd->ShowItem();
?>

<div class="container mt-5">
    <div class="row">
        <?php
        if (!empty($produ)) {
            foreach ($produ as $item) {
                echo "
                        <!-- Imagen del Producto -->
                    <div class='col-md-6'>
                        <img width='400px' src='Assets/Img/Category/SubCategory/{$item['CATEGORIA']}/Products/{$item['NSUBCATEGORIA']}.png' class='img-fluid' alt='Producto'>
                    </div>

                    <!-- Información del Producto -->
                    <div class='col-md-6'>
                        <h3 class='fw-bold'>{$item['NOMBREPROD']}</h3>
                        <div class='rating mb-2'>

                        </div>
                        <p class='text-success fw-bold'>{$item['EXISTENCIAS']} disponibles</p>
                        <h2 class='fw-bold'>Q{$item['PRECIO']}</h2>

                        <!-- Opciones de entrega -->
                        <div class='delivery-options mt-4'>
                            <p><strong>Presentacion:</strong> {$item['CANTMEDIDA']} {$item['UNIDADMEDIDA']}</p>
                        </div>

                        <!-- Botón Añadir al carrito -->
                        <button class='btn btn-warning btn-lg w-100 mt-4'>Añadir al carrito</button>
                    </div>
                     ";
            }
        }
        ?>
    </div>
</div>