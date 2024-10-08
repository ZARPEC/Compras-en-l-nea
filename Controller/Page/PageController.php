<?php

namespace Controller\Page;
use Model\Page\LinkModel; // referencia hacia la clase model que procesa lo que se envia
class PageController
{

    public function mostrarInicio()//de forma inicial se mostrara la pagina home
    {
        require_once("View/Partials/Template.php");
    }

    public function LinkPage()
    {
        if (isset($_GET['action'])) {   //esta definida la variable action que nos indica a que paagina hace referencia
            //lleva al modelo
            $link=$_GET['action'];
        } else {
            //llevara a la pagina de incio
            $link = "home"; // en caso este vacia la variable lleva a home
        }
        $Reply= LinkModel::LinkModel($link); //devuelde la ruta exacta de la pagina
        require_once($Reply);
    }
}
?>