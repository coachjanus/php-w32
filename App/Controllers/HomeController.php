<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Http\Response;
use App\Core\Render\View;

class HomeController
{
    public $title;
    protected Response $response;
    private View $view;

    public function __construct() {
        $this->view = new View();
    }

    public function index(){
        $this->title = "Welcome to Home page";

        // $body = render('home/index', ['title' => $this->title]);

        $body = $this->view->render('home/index', ['title' => $this->title]);
        
        $this->response = new Response($body);
        $this->response->send();
    }
    
}


