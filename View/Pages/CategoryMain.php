<?php
use Controller\categoryController\CategoryC;
$controller = new CategoryC();  // Asumiendo que el nombre de la clase es CategoryC
$categories = $controller->showCategoryC();
$blockSize = 4;
$totalC = count($categories);
$first = true;

?>
<div class="text-center">
    <h1>Categorias</h1>
</div>
<?php
for ($i = 0; $i < $totalC; $i += $blockSize) {
    echo "<div class='row justify-content-center hover-zoom'>";
    for ($j = $i; $j < $i + $blockSize && $j < $totalC; $j++) {
        echo "
            <div class='col-md-3 mb-4'>
                <a href='?action=products&category={$categories[$j]['CATEGORIA']}' class='card-link' style='text-decoration: none; color: inherit;'>
                    <div class='card h-100 hover-zoom'>
                        <img src='Assets/Img/Category/{$categories[$j]['CATEGORIA']}.png' class='card-img-top' alt='{$categories[$j]['CATEGORIA']}'>
                        <div class='card-body row justify-content-center'>
                            <h5 class='card-title'>{$categories[$j]['CATEGORIA']}</h5>
                          
                        </div>
                    </div>
                </a>
            </div>
        ";
    }
    echo "</div>";
}
?>