<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Http\{Response, BaseController};


class HomeController extends BaseController
{
    protected $response;
    protected string $layout = "app";
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $title = "Welcome to Home Page!";
        $content = $this->view()->render('home/index', compact("title"));

        $this->response = new Response($content);
        $this->response->send();
    }
}
