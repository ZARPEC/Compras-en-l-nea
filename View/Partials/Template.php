<?php
use Controller\Page\PageController;
require_once('autoload.php');

$GetLink = new PageController;
ob_start();
?>

<!DOCTYPE html>
<html lang="Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniSuper</title>
    <link rel="stylesheet" href="Assets/Css/NavBarStyle.css">
    <link href="Assets/Css/bootstrap.min.css" rel="stylesheet">

    <script src="Assets/JS/bootstrap.bundle.min.js"></script>
</head>

<?php
    require_once('View/Partials/NavBar.php');
     $GetLink->LinkPage();
    ?>

<body class="bg-secundary container" >
</body>

<footer class="Main-Footer">
</footer>

</html>
<?php
ob_end_flush();
?>