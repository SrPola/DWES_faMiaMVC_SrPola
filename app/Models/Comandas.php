<?php
    namespace App\Models;

    class Comandas {
        private static $instancia;

        public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase;
            }
            return self::$instancia;
        }

        public function getComandas() {
            $comandas = [];
            foreach (scandir("../app/Config/comandas") as $fichero) {
                if ($fichero != "." && $fichero != ".." && strpos($fichero, "comanda_") === 0) {
                    $comandas[] = $fichero;
                }
            }
            return $comandas;
        }

        public function realizarComanda($fichero) {
            $rutaCompleta = "../app/Config/comandas/".$fichero;
            $nuevoNombre = str_replace("_pendiente.txt", "_realizada.txt", $rutaCompleta);
            rename($rutaCompleta, $nuevoNombre);
        }
    }
