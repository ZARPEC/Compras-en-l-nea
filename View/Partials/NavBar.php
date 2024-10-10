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
                        <a class="nav-link" href="?action=orders">pedidos</a>
                    </li>
                    <li class="nav-item dd">
                        <a class="nav-link" href="#">elemento </a>
                        <ul class="list-unstyled dropdownMenu">
                            <li>
                                <a href="play-based-learning.html">Play-Based Learning</a>
                            </li>
                            <li>
                                <a href="physical-literacy.html">Physical Literacy</a>
                            </li>
                            <li>
                                <a href="steam-curriculum.html">Steam Curriculum</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dd">
                        <a class="nav-link" href="#"> elemento </a>
                        <ul class="list-unstyled dropdownMenu">
                            <li>
                                <a href="nutrition.html">Nutrition</a>
                            </li>
                            <li>
                                <a href="parent-reviews.html">Parent Reviews</a>
                            </li>
                            <li>
                                <a href="enrolment.html">Enrolment</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dd">
                        <a class="nav-link" href="#">elemento</a>
                        <ul class="list-unstyled dropdownMenu">
                            <li>
                                <a href="bhnM-mississauga.html">BH‘n’M - Mississauga</a>
                            </li>
                            <li>
                                <a href="bhnm-brampton.html">BH‘n’M - Brampton</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="?action=login">Iniciar sesion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

</header>