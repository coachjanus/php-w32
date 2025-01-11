<?php
require_once dirname(__DIR__, 2)."/app/Core/http/Response.php";
class AboutController
{
    public $title;
    protected Response $response;

    public function __construct() {
        // echo $this->title;
    }
    public function index(){
        $this->title =  "Welcome to about page";
        $body = render('about/index', ['title' => $this->title]);
        $this->response = new Response($body);
        $this->response->send();
    }
    // render('home/index', compact('title'));
}
