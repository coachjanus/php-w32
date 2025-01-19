<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Http\{Response, BaseController};


class AboutController extends BaseController
{
    public $title;
    protected Response $response;
    
    protected string $layout = "app";



   
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->title =  "Welcome to about page";
        
        $body = $this->view()->render('home/index', ['title' => $this->title]);
        
        $this->response = new Response($body);
        $this->response->send();
    }

}
