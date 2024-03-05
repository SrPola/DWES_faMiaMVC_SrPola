<?php
    namespace App\Models;

    class Carrito {
        private static $instancia;

        public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase;
            }
            return self::$instancia;
        }

        public function agregar($datos_formulario) {
            // Recorre los datos del formulario ($_POST con el nombre $datos_formulario)
            foreach ($datos_formulario as $clave => $valor) {
                // Verifica si la clave comienza con "cantidad_"
                if (strpos($clave, 'cantidad_') === 0) {
                    // Obtiene el identificador del producto (eliminando "cantidad_" de la clave)
                    $identificador = str_replace('cantidad_', '', $clave);
                    $cantidad = $valor;
                    
                    // Verifica si se ha pedido el producto y si el producto no está en el carrito
                    if ($cantidad > 0 && !isset($_SESSION["carrito"]["productos"][$identificador])) {
                        // Si se cumple la condición anterior añade el producto al carrito de la sesión
                        $_SESSION["carrito"]["productos"][$identificador] = array(
                            "tipo" => $datos_formulario["tipo_" . $identificador],
                            "nombre" => str_replace("_", " ", $identificador),
                            "cantidad" => $cantidad,
                            "precio" => $datos_formulario["size_" . $identificador],
                            "precio_total" => $datos_formulario["size_" . $identificador] * $cantidad,
                        );
                    } elseif ($cantidad > 0) {
                        // Si el producto ya está en el carrito, suma la nueva cantidad a la cantidad existente (ignora los tamaños de las pizzas)
                        $_SESSION["carrito"]["productos"][$identificador]["cantidad"] += $cantidad;
                        // Actualiza el precio total del producto en el carrito
                        $_SESSION["carrito"]["productos"][$identificador]["precio_total"] = $_SESSION["carrito"]["productos"][$identificador]["precio"] * $_SESSION["carrito"]["productos"][$identificador]["cantidad"];
                    }
                }
            }
            
            // Tras añadir o actualizar los productos del carrito, actualiza el total del carrito
            $total_carrito = 0;
            foreach ($_SESSION["carrito"]["productos"] as $producto) {
                $total_carrito += $producto["precio_total"];
            }
            $_SESSION["carrito"]["total_carrito"] = $total_carrito;
        }

        public function tramitarPedido() {
            $total_pizzas = 0;

            // Si el carrito no está vacío, guarda el carrito en la base de datos
            if (isset($_SESSION["carrito"]) && !empty($_SESSION["carrito"])) {
                // Genera el ticket de compra
                $ticket = "ticket_".time().".txt";
                $fichero_ticket = fopen("../app/Config/tickets/".$ticket, "w");
                fwrite($fichero_ticket, "Ticket de compra\n");
                fwrite($fichero_ticket, "----------------\n");
                foreach ($_SESSION["carrito"]["productos"] as $producto) {
                    fwrite($fichero_ticket, $producto["nombre"]." x".$producto["cantidad"]." ".$producto["precio_total"]."€\n");
                }
                fwrite($fichero_ticket, "----------------\n");
                fwrite($fichero_ticket, "Total: ".$_SESSION["carrito"]["total_carrito"]."€\n");
                fclose($fichero_ticket);
                

                // Genera la comanda pendiente
                $comanda = "comanda_".pathinfo(str_replace("ticket_", "", $ticket), PATHINFO_FILENAME)."_pendiente.txt"; // Genera el nombre de la comanda pendiente a partir de la fecha del ticket
                $fichero_comanda = fopen("../app/Config/comandas/".$comanda, "w");
                fwrite($fichero_comanda, "Comanda\n");
                fwrite($fichero_comanda, "----------------\n");
                foreach ($_SESSION["carrito"]["productos"] as $producto) {
                    if ($producto["tipo"] == "pizzas") {
                        fwrite($fichero_comanda, $producto["nombre"]." x".$producto["cantidad"]." ".$producto["precio_total"]."€\n");
                        $total_pizzas += $producto["precio_total"];
                    }
                }
                fwrite($fichero_comanda, "----------------\n");
                fwrite($fichero_comanda, "Total: ".$total_pizzas."€\n");
                fclose($fichero_comanda);
                unset($_SESSION["carrito"]);

                // Borra el carrito tramitado y devuelve el nombre del ticket generado para la vista en la que se podrá descargar
                unset($_SESSION["carrito"]);
                return $ticket;
            }
        }
    
    }
