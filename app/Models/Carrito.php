<?php
    namespace App\Models;

    class Carrito {
        private static $instancia;
        private $productos = [];


        public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase;
            }
            return self::$instancia;
        }

        public function agregar($datos_formulario) {
            var_dump($datos_formulario);

            

            $carrito = $_SESSION['carrito'];
            $carrito = "";
            $_SESSION['carrito'] = $carrito;
        }
    }