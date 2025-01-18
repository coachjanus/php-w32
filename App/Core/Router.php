<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Http\Request;

class Router
{
    private array $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function resolve() {
        // $request = new Request();

        $path = Request::uri();
        $method = Request::method();

        $callback = $this->routes[$method][$path] ?? null;

        if($callback === null) {
            http_response_code(404);
            return "404 Not Found";
        }

        if (is_array($callback)) {
            [$class, $method] = $callback;
            $controller = new $class();
            return $controller->$method();
        }

        return $callback();
    }
}