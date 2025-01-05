<?php

require_once __DIR__."/app/core/Router.php";
require_once __DIR__."/routes/web.php";
require_once __DIR__ ."/app/utils/view.php";
 

use App\Core\Router;

spl_autoload_register(function($class) {

    // Ajuste do caminho considerando o namespace
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }

});



$router = new router();
$router->run($routesGet, $routesPost);