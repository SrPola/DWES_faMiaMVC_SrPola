<?php
    namespace App\Controllers;

    class ComandasController extends BaseController {
        public function comandasAction() {
            $data = [
                "perfil" => $_SESSION['perfil']
            ];
            $this->renderHTML("../app/Views/comandas_view.php", $data);
        }
    }
