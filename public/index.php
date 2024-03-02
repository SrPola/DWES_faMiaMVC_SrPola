<?php
    require_once "../vendor/autoload.php";
    
    use App\Core\Router;
    use App\Controllers\IndexController;
    use App\Controllers\CarritoController;

    session_start();

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
        "action" => [CarritoController::class, "CarritoAction"],
        "auth" => ["invitado", "usuario"]) 
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
            exit(http_response_code(401));
        }
    } else {
        exit(http_response_code(404));
    }
