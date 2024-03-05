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
        <main>
            <h3>Pedido tramitado</h3>
            <?php
                if ($data["ticket"] != "" && file_exists("../app/Config/tickets/". $data["ticket"])) {
                    echo "<p>Su pedido ha sido tramitado correctamente</p>";
                    echo "<a href='tickets/".$data["ticket"]."' download='".$data["ticket"]."'>Descargar ticket</a>";
                } else {
                    echo "<p style='color: red;'>¡Error! No se ha podido generar el ticket</p>";
                }
            ?>

            <a class=".submit" href="/" >Salir</a>
            
        </main>
        <footer>
        </footer> 
    </body>
</html>