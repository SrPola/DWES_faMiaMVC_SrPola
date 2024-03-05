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
            <h3>Seleccione productos</h3>
            <form action="carrito/agregar" method="post">
                <div class="productos">
                <?php
                    foreach ($data["productos"] as $producto) {
                        echo "<input type='hidden' name='tipo_".str_replace(" ", "_", $producto["nombre"])."' value='".$data['tipo_producto']."'>";
                        echo "<div>";
                        echo "<img src='imagen/".$producto["imagen"]."' alt='".$producto["nombre"]."'>";
                        echo "<p>".$producto["nombre"]."</p>"; 
                ?>
                        Cantidad: <input type="number" name="<?php echo "cantidad_".str_replace(" ", "_", $producto["nombre"]); ?>" min="0" value="0">
                <?php
                        if ($data["sizes"]) {
                            echo "<select name='size_".str_replace(" ", "_", $producto["nombre"])."'>";
                            foreach ($producto["precio"] as $tamaño => $precio) {
                                echo "<option value='".$producto["precio"][$tamaño]."'>".$tamaño." - ".$precio."€</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<p>".$producto["precio"]."€ por unidad</p>";
                            echo "<input type='hidden' name='size_".str_replace(" ", "_", $producto["nombre"])."' value='".$producto["precio"]."'>";
                        }
                        echo "</div>";
                    }
                ?>
                </div>
                <input type="submit" class="submit" name="submit" value="Añadir al carrito">
            </form>
        </main>
        <footer>
            <h3>Recomendaciones</h3>
        </footer> 

    </body>
</html>