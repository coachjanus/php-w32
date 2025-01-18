<?php

declare(strict_types=1);

class AutoLoader
{
    public static function classLoader(string $class) {
        $fqcnToPath = fn(string $fqcn) => str_replace('\\', DIRECTORY_SEPARATOR, $fqcn).'.php';

        // App/Controllers/HomeController.php

        $path = $fqcnToPath($class);
        $filePath = dirname(__DIR__).DIRECTORY_SEPARATOR.$path;

        if(is_file($filePath) && is_readable($filePath)) {
            require_once $filePath;
        }
    }
}

spl_autoload_register('AutoLoader::classLoader');