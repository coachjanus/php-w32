<?php

declare(strict_types=1);

namespace App\Core\Render;

class View
{
    public function render($view, $context = []) {

        ob_start();
        $content = $this->load($view, $context);
        require_once dirname(__DIR__, 3)."/views/layouts/app.php";
    
        return str_replace("{{ content }}", $content, ob_get_clean());
    }
    
    private function load($view, $context) {
        $path = dirname(__DIR__, 3)."/views/";
        if(!file_exists($file = $path.$view.".php")) {
            throw new \Exception(sprintf('The file %s could not found.', $file));
        }
        extract($context);
        ob_start();
        include $file;
        return ob_get_clean();
    }
}