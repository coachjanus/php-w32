<?php

namespace App\Controllers\Admin;

use App\Core\Http\{Response, BaseController};

class Dashboard extends BaseController
{
    protected string $layout = "admin";

    public $title;
    protected Response $response;

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->title = "Welcome to Admin dashboard";

        $body = $this->view()->render('admin/index', ['title' => $this->title]);
        
        $this->response = new Response($body);
        $this->response->send();
    }


}