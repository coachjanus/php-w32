<?php

namespace App\Core\Http;

use App\Core\Kernel;
use App\Core\Render\View;

class BaseController
{

    private View $view;
    protected string $layout;

    public function __construct() {
        $templates = Kernel::projectDir()."/views";
        $this->view = new View($templates, $this->layout);
    }

    protected function view() {
        return $this->view;
    }
}