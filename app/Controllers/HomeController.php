<?php

require_once dirname(__DIR__, 2)."/app/Core/http/Response.php";

class HomeController
{
    // public $title = "Welcome to Home page";
    public $title;
    protected Response $response;

    public function __construct() {
        // echo $this->title;
        // $this->title = "Welcome to Home page";
        // render('home/index', ['title' => $this->title]);
    }

    public function index(){
        $this->title = "Welcome to Home page";
        $body = render('home/index', ['title' => $this->title]);
        $this->response = new Response($body);
        $this->response->send();
    }
    // render('home/index', compact('title'));
}


