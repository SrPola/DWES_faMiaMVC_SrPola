<?php
    namespace App\Controllers;

    use App\Models\Carrito;

    class CarritoController extends BaseController {
        public function CarritoAction($request) {
            $_SESSION["carrito"] = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : [];

            if ($request == "/carrito/agregar") {
                $carrito = Carrito::getInstancia();
                $carrito->agregar($_POST);
                header("Location: /carrito");
            } else {
                $data = [
                    "carrito" => $_SESSION['carrito']
                ];
                // var_dump($_SESSION['carrito']["productos"]);
                // echo "<br>";
                // var_dump($_SESSION['carrito']["total_carrito"]);
                $this->renderHTML("../app/Views/carrito_view.php", $data);
            }
        }

        public function comandasAction() {
            $data = [
                "perfil" => $_SESSION['perfil']
            ];
            $this->renderHTML("../app/Views/comandas_view.php", $data);
        }
    }
    