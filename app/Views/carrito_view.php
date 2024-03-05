<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="SrPola">
        <link rel="stylesheet" href="css/style.css">
        <title>faMia</title>
    </head>
    <body>
        <header>
            <h1>faMia</h1>
        </header>
        <nav>
            <ul>
                <li><a href="/pizzas">Pizzas</a></li>
                |
                <li><a href="/bebidas">Bebidas</a></li>
                |
                <li><a href="/postres">Postres</a></li>
                ::
                <li><a href="/carrito">Carrito</a></li>
            </ul>
        </nav>
        <main>
            <h3>Su carrito</h3>
            <?php
                if (isset($data["carrito"]) && !empty($data["carrito"])) {
                    echo "<table>";
                    echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Precio Total</th></tr>";
                    foreach ($data["carrito"]["productos"] as $producto) {
                        echo "<tr>";
                        echo "<td>".$producto["nombre"]."</td>";
                        echo "<td>".$producto["cantidad"]."</td>";
                        echo "<td>".$producto["precio"]."€</td>";
                        echo "<td>".$producto["precio_total"]."€</td>";
                        echo "</tr>";
                        
                    }
                    echo "<tr><td colspan='3'>Total</td><td>".$data["carrito"]["total_carrito"]."€</td></tr>";
                    echo "</table>";
                    echo "<div class='botones'>";
                    echo "<a href='clear_carrito' class='submit'>Borrar Carrito</a>";
                    echo "<a href='tramitar_pedido' class='submit'>Tramitar pedido</a>";
                    echo "</div>";
                } else {
                    echo "<p>El carrito está vacío</p>";
                }
            ?>
            <?php
            ?>
        </main>
        <footer>
        </footer> 

    </body>
</html>