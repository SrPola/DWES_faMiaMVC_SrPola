<?php
    namespace App\Controllers;

    use App\Models\Carrito;

    class CarritoController extends BaseController {
        public function carritoAction($request) {
            $_SESSION["carrito"] = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : [];

            if ($request == "/carrito/agregar") {
                if (!empty($_POST)) {
                    $carrito = Carrito::getInstancia();
                    $carrito->agregar($_POST);
                    header("Location: /carrito");
                } else {
                    header("Location: /carrito");
                }
            } 
            $data = [
                "carrito" => $_SESSION['carrito']
            ];
            $this->renderHTML("../app/Views/carrito_view.php", $data);
        }

        public function tramitarPedidoAction() {
            $carrito = Carrito::getInstancia();
            $data = [
                "ticket" => $carrito->tramitarPedido(),
            ];
            $this->renderHTML("../app/Views/pedido_tramitado_view.php", $data);
        }
    }
    