<?php
    namespace App\Controllers;

    use App\Models\Carrito;

    include_once '../app/Config/config.php';
    define("productos", $productos);

    class CarritoController extends BaseController {
        public function CarritoAction($request) {
            if ($request == "/carrito/agregar") {
                $carrito = Carrito::getInstancia();
                $carrito->agregar($_POST);
            } else {
                $data = [
                    "carrito" => $_SESSION['carrito']
                ];
                $this->renderHTML("../app/Views/carrito_view.php", $data);
            }
        }
    }
    