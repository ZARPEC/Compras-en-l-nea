<?php
namespace Model\Page;

class LinkModel{ // clase para rediregir a las diferentes paginas con metodo get

    public static function LinkModel($Link){
        
        $GeLink = match($Link){
            "home" => "View/pages/home.php",
            "homeUser" => "view/user/homeU.php",
            "login" => "View/account/login.php",
            "signUp" => "View/account/SignUp.php",
            "products" => "View/pages/ListProduct.php",
            "conn" =>"View/account/conexion.php",
            default => "View/pages/error.php"

        };
        return $GeLink;
    }
}
