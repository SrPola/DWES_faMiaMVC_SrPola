<?php
    namespace App\Controllers;

    class IndexController extends BaseController {
        public function indexAction($request){ // De momento no existe IndexController
            $sizes = false;

            if($request == "/"){
                header("Location: /pizzas");
            }

            $tipo_producto = ltrim($request, "/");
            
            if ($tipo_producto == "pizzas") {
                $sizes = true;
            }
            
            $data = [
                "productos" => productos[$tipo_producto],
                "sizes" => $sizes,
                "tipo_producto" => $tipo_producto,
            ];
            $this->renderHTML("../app/Views/index_view.php", $data); // La ruta parte de la ubicacion del fichero index.php
        }

        public function imagenAction($request) {
            $imagen = "../app/Config/img/".basename($request);

            if (file_exists($imagen)){
                header('Content-Type: image/jpg');
                readfile($imagen);
            } else {
                exit(http_response_code(404));
            }
        }

        public function closeSession() {
            unset($_SESSION["perfil"]);
            header("Location: login");
        }

        public function clearCarrito() {
            unset($_SESSION["carrito"]);
            header("Location: carrito");
        }
    }
