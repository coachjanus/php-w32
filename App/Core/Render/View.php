<?php

declare(strict_types=1);

namespace App\Core\Render;

final class View
{
    public function __construct(private string $path, protected string $layout) {
        $this->layout = $layout;
        $this->path = rtrim($path, '/').'/';

    }
    public function render($view, $context = []) {

        ob_start();
        $layout = Layout::getInstance($this->path, $this->layout);

        $content = $this->load($view, $context);

        // require_once dirname(__DIR__, 3)."/views/layouts/app.php";
    
        return str_replace("{{ content }}", $content, ob_get_clean());
    }
    
    private function load($view, $context) {
        $path = dirname(__DIR__, 3)."/views/";
        if(!file_exists($file = $this->path.$view.".php")) {
            throw new \Exception(sprintf('The file %s could not found.', $file));
        }
        
        ob_start();
        extract($context);
        include $file;
        return ob_get_clean();
    }
}