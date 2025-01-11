<?php


class Request
{

    public static function uri(): string {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public static function redirect($location="") {
        header("Location http://".$_SERVER['HTTP_HOST'].$location);
        exit();
    }
}