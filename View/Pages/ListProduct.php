<?php
use Controller\categoryController\CategoryC;
$controller = new CategoryC();  // Asumiendo que el nombre de la clase es CategoryC
$categories = $controller->showCategoryC();
$SubCategories = $controller->showSubCategoryC();
$blockSize = 5;
$totalSubC = count($SubCategories);
$first = true;

?>
<style>
        .category-circle {
            width: 100px;
            height: 100px;
            background-color: #17A2B8;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }
        .category-circle img {
            width: 60px;
            height: auto;
        }
        .category-text {
            text-align: center;
            font-size: 14px;
        }
    </style>

<div class="container mt-5">
    <div class="row">
        <!-- Sidebar de categorías -->
        <div class="col-md-3">
            <h5>Categorías</h5>
            <ul class="list-group">
                <?php
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        echo "<li class='list-group-item'>
                                    <a href='?action={$category['CATEGORIA']}'>{$category['CATEGORIA']}</a></li>";
                    }
                }
                ?>

            </ul>
        </div>
        <!-- espacio para mostrar subcategorias -->

        <!-- Sección de productos -->
        <div class="col-md-9">

            <!--seccion de subcategorias -->
            <div class="container mt-5">
                <h2 class="mb-4">Electrónicos</h2>
                <div id="categoryCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Grupo 1 de categorías -->

                        <?php
                for ($i = 0; $i < $totalSubC; $i += $blockSize) {
                    // Este segundo for se asegura de imprimir solo hasta 5 o los elementos que queden
                    for ($j = $i; $j < $i + $blockSize && $j < $totalSubC; $j++) {
                        if ($first == true){
                            echo "<div class='carousel-item active'>"; 
                            $first = false;
                        }else{
                            echo "<div class='carousel-item '>";
                        }
                        echo "
                        
                            <div class='row text-center'>
                                <div class='col-2 rounded '>
                                    <div class='category-circle'>
                                        <img src='https://via.placeholder.com/80' alt='Audio'>
                                    </div>
                                    <p class='category-text'>{$SubCategories[$j]['NSUBCATEGORIA']}</p>
                                </div>
                                <div class='col-2'>
                                    <div class='category-circle'>
                                        <img src='https://via.placeholder.com/80' alt='Impresoras'>
                                    </div>
                                    <p class='category-text'>{$SubCategories[$j]['NSUBCATEGORIA']}</p>
                                </div>
                                <div class='col-2'>
                                    <div class='category-circle'>
                                        <img src='https://via.placeholder.com/80' alt='Redes'>
                                    </div>
                                    <p class='category-text'>{$SubCategories[$j]['NSUBCATEGORIA']}</p>
                                </div>
                                <div class='col-2'>
                                    <div class='category-circle'>
                                        <img src='https://via.placeholder.com/80' alt='Smartwatch'>
                                    </div>
                                    <p class='category-text'>{$SubCategories[$j]['NSUBCATEGORIA']}</p>
                                </div>
                                <div class='col-2'>
                                    <div class='category-circle'>
                                        <img src='https://via.placeholder.com/80' alt='Smart Home'>
                                    </div>
                                    <p class='category-text'>{$SubCategories[$j]['NSUBCATEGORIA']}</p>
                                </div>
                            </div>
                        </div>
";
                    }
                    echo "</ul>";
                }
                ?>

                    </div>

                    <!-- Controles de carrusel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
            <!--fin seccion subcategorias-->



            <!--seccion de productos-->
            <h5>Productos</h5>
            <div class="row">
                <!-- Producto 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto 1">
                        <div class="card-body">
                            <h5 class="card-title">Producto 1</h5>
                            <p class="card-text">Descripción breve del producto.</p>
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto 2">
                        <div class="card-body">
                            <h5 class="card-title">Producto 2</h5>
                            <p class="card-text">Descripción breve del producto.</p>
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Producto 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto 3">
                        <div class="card-body">
                            <h5 class="card-title">Producto 3</h5>
                            <p class="card-text">Descripción breve del producto.</p>
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Producto 4 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto 4">
                        <div class="card-body">
                            <h5 class="card-title">Producto 4</h5>
                            <p class="card-text">Descripción breve del producto.</p>
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>


                <!-- Producto 5 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto 5">
                        <div class="card-body">
                            <h5 class="card-title">Producto 5</h5>
                            <p class="card-text">Descripción breve del producto.</p>
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>

                <!-- Producto 6 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Producto 6">
                        <div class="card-body">
                            <h5 class="card-title">Producto 6</h5>
                            <p class="card-text">Descripción breve del producto.</p>
                            <a href="#" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>