<?php

namespace App\Core\Render;

final class Layout
{
    private static ?Layout $instance = null;

    public static function getInstance($path, $layout) {
        if (self::$instance === null) {
            ob_start();
            self::$instance = new self();
            require_once "{$path}/layouts/{$layout}.php";
        }
        return self::$instance;
    }

}