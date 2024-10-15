<?php
use Controller\categoryController\CategoryC;
$controller = new CategoryC();  // Asumiendo que el nombre de la clase es CategoryC
$categories = $controller->showCategoryC();
$Cont = 0;


?>

<header class="container-fluid bg-white">

    <div class="container px-0 menuContainer">
        <nav class="navbar navbar-expand-xl navbar-light align-items-end p-xl-0">


            <a href="#mobileMenu" id="mobileBar" class="d-none ml-auto"> <i class="fa fa-bars"></i></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-md-auto justify-content-between" id="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="?action=home">Inicio</a>
                    </li>
                    <li class="nav-item dd">
                        <a class="nav-link" href="?action=CatMain" >Categorias</a>
                        <ul class="list-unstyled dropdownMenu">
                            <?php

                            if (!empty($categories)) {

                                foreach ($categories as $category) {
                                    if ($Cont < 5) {
                                        echo "<li class='nav-item dd list-group-item'>
                                         <a href='?action=products&category={$category['CATEGORIA']}'>{$category['CATEGORIA']}</a>
                                       </li>";
                                        $Cont++;
                                    }
                                }
                            }
                            ?>
                            <li class="nav-item dd">
                                <a href="?action=CatMain">más categorias</a>
                            </li>
                           
                        </ul>
                    </li>
                    <li class="nav-item dd">
                        <a class="nav-link" href="?action=search">pedidos</a>
                    </li>
                    <li class="nav-item dd">
                        <a class="nav-link" href="#">elemento </a>
                        <ul class="list-unstyled dropdownMenu">
                            
                        </ul>
                    </li>
                    <li class="nav-item dd">
                        <a class="nav-link" href="#"> elemento </a>
                        <ul class="list-unstyled dropdownMenu">
                            
                        </ul>
                    </li>
                    <li class="nav-item dd">
                        <a class="nav-link" href="#">elemento</a>
                        <ul class="list-unstyled dropdownMenu">
                            
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="?action=login">Iniciar sesion</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="?action=ShoppingCart"><i class="fa-solid fa-cart-plus fa-2xl"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

</header>