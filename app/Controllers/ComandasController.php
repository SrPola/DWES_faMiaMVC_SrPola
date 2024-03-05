<?php
    namespace App\Controllers;

    use App\Models\Comandas;

    class ComandasController extends BaseController {
        public function comandasAction() {
            $data = [
                "perfil" => $_SESSION['perfil'],
                "comandas" => Comandas::getInstancia()->getComandas(),
            ];
            $this->renderHTML("../app/Views/comandas_view.php", $data);
        }

        public function realizarAction($request) {
            $comanda = explode("/", $request);
            $comanda = end($comanda);
            $comandas = Comandas::getInstancia();
            $comandas->realizarComanda($comanda);
            header("Location: /comandas");
        }
    }
