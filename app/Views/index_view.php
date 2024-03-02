<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="SrPola">
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            h1 {
                margin: 20px 0;
            }

            nav ul li {
                display: inline-block;
                margin: 0 10px;
            }

            nav ul li a {
                text-decoration: none;
                display: block;
                color: black;
            }

            img {
                width: 100px;
                display: block;
            }

            input {
                width: 70px;
            }

            div {
                display: inline-block;
                margin: 20px;
            }

            .submit {
                display: block;
                width: auto;
                border: 1px solid black;
                padding: 5px;
                background-color: rgba(127, 255, 212, 0.61);
            }

            select {
                display: block;
            }
        </style>
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
            <form action="http://famiamvc.local/carrito/agregar" method="post">
                <?php
                    foreach ($data["productos"] as $producto) {
                        echo "<div>";
                        echo "<img src='imagen/".$producto["imagen"]."' alt='".$producto["nombre"]."'>";
                        echo "<p>".$producto["nombre"]."</p>"; 
                ?>
                        Cantidad: <input type="number" name="<?php echo "cantidad_".str_replace(" ", "_", $producto["nombre"]); ?>" value="0">
                <?php
                        if ($data["sizes"]) {
                            echo "<select name='size_".str_replace(" ", "_", $producto["nombre"])."'>";
                            foreach ($producto["precio"] as $tamaño => $precio) {
                                echo "<option value='".$producto["precio"][$tamaño]."'>".$tamaño." - ".$precio."€</option>";
                            }
                            echo "</select>";
                        }
                        echo "</div>";
                    }
                ?>
                <input type="submit" class="submit" name="submit" value="Añadir al carrito">
            </form>
        </main>
        <footer>
            <h3>Recomendaciones</h3>
        </footer> 

    </body>
</html>