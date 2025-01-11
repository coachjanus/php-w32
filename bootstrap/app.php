<?php

declare(strict_types=1);

require_once dirname(__DIR__)."/app/Core/http/Request.php";

error_reporting(0);

define('ROOT', dirname(__DIR__));

// function uri(): string {
//     return trim($_SERVER['REQUEST_URI'], '/');
// }

// function home() {
//     include ROOT.'/app/Controllers/HomeController.php';
//     $homeController = new HomeController();
//     var_dump($homeController);
// }

function boot() {
    date_default_timezone_set(getenv('APP_TIMEZONE') ? : 'UTC');
}

$_ENV['APP_ENV'] = 'dev';
$_ENV['APP_TIMEZONE'] = 'UTC';


if (getenv('APP_ENV') == 'dev') {
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', '1');
}

boot();


function render($view, $context = []) {

    ob_start();
    $content = load($view, $context);
    require_once dirname(__DIR__)."/views/layouts/app.php";

    return str_replace("{{ content }}", $content, ob_get_clean());
}

function load($view, $context) {
    $path = dirname(__DIR__)."/views/";
    if(!file_exists($file = $path.$view.".php")) {
        throw new \Exception(sprintf('The file %s could not found.', $file));
    }
    extract($context);
    ob_start();
    include $file;
    return ob_get_clean();
}


$request = Request::uri();

$routes = require_once dirname(__DIR__)."/config/routes.php";

// foreach ($routes as $route) {
//     echo "$request => $route";
//     if (array_key_exists($request, $route)){
//         echo "$request => $route";
//     }
    
// }

if (array_key_exists($request, $routes)){
    // echo "$request => $routes[$request]";
    $segments = $routes[$request];

    [$controllerClass, $action] = explode("@", $segments);


    // $controllerClass = $routes[$request];


    include_once dirname(__DIR__)."/app/Controllers/$controllerClass.php";
    $controller = new $controllerClass();
    // $controller->index();
    $controller->$action();
    // var_dump($controller) ; 
} else {
    require_once dirname(__DIR__)."/app/Controllers/ErrorController.php";
    new ErrorController();
}
