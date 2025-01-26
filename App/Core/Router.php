<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Http\Request;

class Router {
    private array $routes = [];
    public function __construct(private Request $request)   {
        $this->request = $request;
    }
    public function add(string $method, string $path, callable|array $callback): void    {
        $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = "#^$pattern$#";
        $this->routes[$method][$pattern] = $callback;
    }
    public function get($path, $callback)   {
        return $this->add('GET', $path, $callback);
    }
 
    public function post($path, $callback)   {
        return $this->add('POST', $path, $callback);
    }
    public function resolve(): mixed   {

        $method = Request::method();
        $path = Request::uri();
       
        $path = explode('?', $path)[0];
       
        foreach ($this->routes[$method] ?? [] as $pattern => $callback) {
            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter(
                    $matches,
                    fn($key) => !is_numeric($key),
                    ARRAY_FILTER_USE_KEY
                );
 

                if (is_array($callback)) {
                    [$class, $method] = $callback;
                    $controller = new $class($this->request);
                    return $controller->$method($params);
                }
               
                return $callback($params);
            }
        }
       
        http_response_code(404);
        return "404 Not Found";
    }
}   