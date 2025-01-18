<?php
declare(strict_types=1);

namespace App\Core\Http;

class Request
{
    public static function uri(): string {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public static function method(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function redirect($location="") {
        header("Location http://".$_SERVER['HTTP_HOST'].$location);
        exit();
    }
}