<?php

namespace App\Controllers\Admin;

use App\Core\Http\{Response, BaseController, Request};
use App\Models\Brand;

class BrandController extends BaseController
{
    protected string $layout = "admin";

    public $title;
    protected Response $response;
    protected $model;

    public function __construct(private Request $request) {
        parent::__construct();
        $this->model = new Brand();
        $this->request = $request;
    }

    public function index(){
        $this->title = "Brands management";
        $brands = $this->model->selectAll();
        $body = $this->view()->render('admin/brands/index', ['title' => $this->title, 'brands'=>$brands]);
        
        $this->response = new Response($body);
        $this->response->send();
    }

    public function create() {
        $title = "Create new Brand";
        $body = $this->view()->render('admin/brands/create', ['title' => $this->title]);
        
        $this->response = new Response($body);
        $this->response->send();

    }

    public function store() {
        $res = $this->model->insert(['name'=>$this->request->get('name'), 'description'=>$this->request->get('description')]);
        if ($res) {
            return $this->redirect('/admin/brands');
        }
      
    }

    public function edit($param) {

        extract($param);

        $title = "Edit Brand";
        $brand = $this->model->get($id);


        $body = $this->view()->render('admin/brands/edit', ['title' => $this->title, 'brand'=>$brand]);
        
        $this->response = new Response($body);
        $this->response->send();

    }

    public function update()   {
        $this->model->update(['id' => $this->request->get('id'), 'name' => $this->request->get('name'), 'description' => $this->request->get('description')]);
        $this->redirect('/admin/brands');
    }

    public function destroy($params)
    {
        extract($params);
        $this->model->delete($id);
        return $this->redirect('/admin/brands');
    }
} 






 
    
 