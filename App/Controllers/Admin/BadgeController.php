<?php
declare(strict_types=1);

namespace App\Controllers\Admin;
 
use App\Core\Http\{Request, BaseController, Response};
use App\Models\Badge;


class BadgeController extends BaseController
{
    protected string $layout = "admin";
    protected $model;
    protected Response $response;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new Badge();
        $this->request = $request;
    }

    public function index()
    {
        $title = "All badges";
        $badges = $this->model->selectAll();
        $body = $this->view()->render(view: 'admin/badges/index', context: compact('title',  'badges'));

        $this->response = new Response($body);
        $this->response->send();
    }
    
    public function create()
    {
        $title = "New badge";
        $body = $this->view()->render(view: 'admin/badges/create', context: compact(var_name: 'title'));

        $this->response = new Response($body);
        $this->response->send();
    }

    public function store()
    {
        $this->model->insert(['title' => $this->request->get('title')]);
        $this->redirect('/admin/badges');   
    }

    public function show($params)
    {
        extract($params);
       
    }

    public function edit($params)
    {

        extract($params);
        $brand = $this->brand->first($id);
        return $this->render('admin/brands/edit', ['brand' => $brand ]);
       
    }

    public function update1($params)
    {
        extract($params);
        $this->brand->id = $id;
        $this->brand->name = $this->request->name;
        $this->brand->description = $this->request->description;
        $this->brand->save();  
    }

    public function update()
    {
        
        $this->brand->id = $this->request->id;
        $this->brand->name = $this->request->name;
        $this->brand->description = $this->request->description;
        $this->brand->save();  
    }


    public function destroy($params)
    {
        extract($params);
        $this->brand->delete($id);
    }

}