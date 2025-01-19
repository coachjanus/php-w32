<?php

namespace App\Controllers\Admin;

use App\Core\Http\{Response, BaseController};
use App\Models\Brand;

class BrandController extends BaseController
{
    protected string $layout = "admin";

    public $title;
    protected Response $response;
    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Brand();
    }

    public function index(){
        $this->title = "Brands management";
        $brands = $this->model->selectAll();
        $body = $this->view()->render('admin/brands/index', ['title' => $this->title, 'brands'=>$brands]);
        
        $this->response = new Response($body);
        $this->response->send();
    }


}