<?php
    namespace App\Controllers;

    class AuthController extends BaseController {
        public function loginAction(){ 
            if (empty($_POST)) {
                $this->renderHTML("../app/Views/login_view.php");
            } else {
                if ($_POST['user'] == USER && $_POST['password'] == PASS) {
                    $_SESSION['perfil'] = "usuario";
                    header("Location: comandas");
                } else {
                    header("Location: login");
                }
            }
        }
    }
