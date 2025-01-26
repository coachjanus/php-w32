<?php

namespace App\Core\Http;

class Request
{

    protected array $data;

    public function __construct()
    {
        // $this->data = $_REQUEST;
        
        $this->data = $this->prepare($_REQUEST, $_FILES);

    }

    private function prepare(array $request, array $files)
    {
        $request = $this->clean($request);
        return array_merge($files, $request);
    }

    private function clean($data)
    {
        if (is_array($data)) {
            $cleaned = [];
            foreach($data as $key => $value) {
                $cleaned[$key] = $this->clean($value);
            }
            return $cleaned;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }

    public function get(string $key, string $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    public static function uri(): string
    {
        return trim(
            string: parse_url(url: $_SERVER['REQUEST_URI'], component: PHP_URL_PATH), characters: '/'
        );
    }
    
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function redirect($location)
    {
        header('Location: http://'.$_SERVER['HTTP_HOST'].$location);
        exit();
    }
 

}