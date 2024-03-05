<?php
    require_once "../vendor/autoload.php";

    include_once '../app/Config/config.php';

    include_once '../bootstrap.php';
    
    use App\Core\Router;
    use App\Controllers\IndexController;
    use App\Controllers\CarritoController;
    use App\Controllers\AuthController;
    use App\Controllers\ComandasController;
    
    session_start();
    
    define("productos", $productos);
    
    if (!isset($_SESSION['perfil'])) {
        $_SESSION['perfil'] = "invitado";
    }

    $router = new Router();
    $router->add(array(
        "name" => "home", 
        "path" => "/^\/(pizzas|bebidas|postres)?$/",
        "action" => [IndexController::class, "indexAction"], 
        "auth" => ["invitado", "usuario"]) 
    );

    // Router que devuelve la imagen espeficiada en la URL a la vista
    $router->add(array(
        "name" => "imagen",
        "path" => "/^\/imagen\/(.+)$/",
        "action" => [IndexController::class, "imagenAction"],
        "auth" => ["invitado", "usuario"]
    ));

    $router->add(array(
        "name" => "carrito",
        "path" => "/^\/carrito(\/agregar)?$/",
        "action" => [CarritoController::class, "carritoAction"],
        "auth" => ["invitado", "usuario"]) 
    );

    $router->add(array(
        "name" => "Login",
        "path" => "/^\/login$/",
        "action" => [AuthController::class, "loginAction"],
        "auth" => ["invitado", "usuario"]) 
    );

    $router->add(array(
        "name" => "Cerrar sesion",
        "path" => "/^\/close_session$/",
        "action" => [IndexController::class, "closeSession"],
        "auth" => ["invitado", "usuario"]) 
    );

    $router->add(array(
        "name" => "Borrar carrito",
        "path" => "/^\/clear_carrito$/",
        "action" => [IndexController::class, "clearCarrito"],
        "auth" => ["invitado", "usuario"]) 
    );

    $router->add(array(
        "name" => "Tramitar pedido",
        "path" => "/^\/tramitar_pedido$/",
        "action" => [CarritoController::class, "tramitarPedidoAction"],
        "auth" => ["invitado", "usuario"]) 
    );

    $router->add(array(
        "name" => "Descargar tickets",
        "path" => "/^\/tickets\/(.+).txt$/",
        "action" => [IndexController::class, "ticketsAction"],
        "auth" => ["invitado", "usuario"]) 
    );

    $router->add(array(
        "name" => "Gertor de comandas",
        "path" => "/^\/comandas$/",
        "action" => [ComandasController::class, "comandasAction"],
        "auth" => ["usuario"]) 
    );

    $router->add(array(
        "name" => "Realizar comandas",
        "path" => "/^\/realizar_comanda\/(.+)_pendiente.txt$/",
        "action" => [ComandasController::class, "realizarAction"],
        "auth" => ["usuario"]) 
    );

    $request = $_SERVER['REQUEST_URI']; // Recoje URL
    $route = $router->match($request); // Busca en todas las rutas hasta encontrar cual coincide con la URL
    
    if ($route) {
        if (in_array($_SESSION['perfil'], $route['auth'])) {
            $className = $route['action'][0];
            $classMethod = $route['action'][1];
            $object = new $className;
            $object->$classMethod($request);
        } else {
            header("Location: /login");
        }
    } else {
        exit(http_response_code(404));
    }
