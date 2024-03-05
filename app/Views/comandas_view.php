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
            <h3>Gestor de comandas</h3>
            <?php
                echo "<p>Bienvenido, usted está como ".$_SESSION["perfil"]."</p>";
                echo "<a href='close_session'>Cerrar session</a>";

                echo "<table>";
                echo "<tr><th>Comandas</th></tr>";
                foreach ($data["comandas"] as $comanda) {
                    echo "<tr><td>".$comanda."</td>";
                    $partes_comanda = explode("_", $comanda);
                    if (end($partes_comanda) == "pendiente.txt") {
                        echo "<td><a href='/realizar_comanda/".$comanda."'>Realizar comanda</a></td>";    
                    }
                    
                    echo "</tr>";
                }
            ?>
        </main>
        <footer>
        </footer> 
    </body>
</html>