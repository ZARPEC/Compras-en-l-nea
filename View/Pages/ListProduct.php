<?php
use Controller\categoryController\CategoryC;
$controller = new CategoryC();  // Asumiendo que el nombre de la clase es CategoryC
$categories = $controller->showCategoryC();
$SubCategories = $controller->showSubCategoryC();
$totalSubC = count($SubCategories);
$first = true;
$CategoryGet = $_GET['category'];
$blockSize = 5;
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

    .custom-prev,
    .custom-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background-color: rgba(0, 0, 0, 0.5);
        /* Fondo semitransparente */
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .custom-prev {
        left: -60px;
        /* Ajusta esta distancia para separar la flecha del primer elemento */
    }

    .custom-next {
        right: -60px;
        /* Ajusta esta distancia para separar la flecha del último elemento */
    }

    .custom-prev:hover,
    .custom-next:hover {
        background-color: rgba(0, 0, 0, 0.8);
        /* Color más oscuro al pasar el mouse */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 20px;
        height: 20px;
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
                                    <a href='?action=products&category={$category['CATEGORIA']}'>{$category['CATEGORIA']}</a></li>";
                    }
                }
                ?>
            </ul>
        </div>

        <!-- Contenedor de subcategorías y productos -->
        <div class="col-md-9">
            <!-- Sección de subcategorías -->
            <div class="container mb-4 w-75">
                <h2 class="mb-4"><?php echo "{$CategoryGet}";?></h2>
                <div id="categoryCarousel" class="carousel slide" data-bs-ride="carouse">
                    <div class="carousel-inner">
                        <?php
                        for ($i = 0; $i < $totalSubC; $i += $blockSize) {
                            if ($first == true) {
                                echo "<div class='carousel-item active'>";
                                $first = false;
                            } else {
                                echo "<div class='carousel-item'>";
                            }
                            echo "<div class='row'>";
                            for ($j = $i; $j < $i + $blockSize && $j < $totalSubC; $j++) {
                                echo "
                                <div class='col text-center'>
                                    <div class='col rounded'>
                                        <div class='category-circle'>
                                            <img src='Assets/Img/Category/SubCategory/{$CategoryGet}/{$SubCategories[$j]['NSUBCATEGORIA']}.png' alt='Subcategoría'>
                                        </div>
                                        <p class='category-text'>{$SubCategories[$j]['NSUBCATEGORIA']}</p>
                                    </div>
                                </div>
                                ";
                            }
                            echo "</div>"; // Cierra el row
                            echo "</div>"; // Cierra el carousel-item
                        }
                        ?>
                    </div>
                    <!-- Controles de carrusel -->
                    <button class="carousel-control-prev custom-prev" type="button" data-bs-target="#categoryCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next custom-next" type="button" data-bs-target="#categoryCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>

            <!-- Sección de productos -->
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
        </div> <!-- Fin de la columna de productos/subcategorías -->
    </div> <!-- Fin del row -->
</div> <!-- Fin del container -->