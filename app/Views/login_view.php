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
            <h3>Iniciar sesión</h3>
            <?php
                if ($_SESSION['perfil'] != "invitado") {
                    header("Location: comandas");
                }
            ?>
            <form action="login" method="post">
                <div>
                    <label for="user">Usuario:</label>
                    <input type="text" name="user" id="user" required>
                </div>
                <div>
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <input type="submit" class="submit" name="submit" value="Iniciar sesión">
            </form>
        </main>
        <footer>
        </footer> 
    </body>
</html>