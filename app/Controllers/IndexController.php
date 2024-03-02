<?php
    namespace App\Controllers;

    class IndexController extends BaseController{
        public function indexAction(){ // De momento no existe IndexController
            $data = [
                "message" => "Hello World!"
            ];
            $this->renderHTML("../app/Views/index_view.php", $data); // La ruta parte de la ubicacion del fichero index.php
        }
    }
