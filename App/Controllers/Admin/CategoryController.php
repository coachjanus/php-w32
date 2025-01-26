<?php
declare(strict_types=1);

namespace App\Controllers\Admin;
 
use App\Core\Http\{Request, BaseController, Response};
use App\Models\{Category, Section};
use App\Core\Traits\{Upload};

class CategoryController extends BaseController
{
   use Upload;

   protected string $layout = "admin";
   protected $model;
   protected Response $response;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->model = new Category();
    }

    public function index()
    {
        $categories = $this->model->selectAll();
        $title = "All categories";
        $body = $this->view()->render(view: 'admin/categories/index', context: compact('title',  'categories'));
        
        $this->response = new Response($body);
        $this->response->send();
    }
    
    public function create()
    {
        $sections = (new Section())->selectAll();
        $title = "New category";
        $body = $this->view()->render(view: 'admin/categories/create', context: compact( 'title', 'sections'));

        $this->response = new Response($body);
        $this->response->send();
    }

    public function store()
    {
        $cover = $this->request->get('cover');
       
        $cover = $this->upload($cover, "storage/categories");

        $this->model->insert([
            'name' => $this->request->get('name'), 
            'section_id' => $this->request->get('section_id'), 
            'cover' => $cover 
        ]);
        $this->redirect('/admin/categories');
    }

    public function show($params)
    {
        extract($params);
    }

    public function edit($params)
    {
        extract($params);
        $title = "Edit category";
        $sections = (new Section())->selectAll();
        $category = $this->model->get($id);

        $body = $this->view()->render(view: 'admin/categories/edit', context: compact( 'title', 'category', 'sections'));

        $this->response = new Response($body);
        $this->response->send();

    }

    public function update()
    {
        if (!$this->request->get('cover')) {
            $cover = $this->request->get('_cover');
        } else {

            $cover = $this->request->get('cover');

            $cover = $this->upload($cover, "storage/categories");

            $segment = explode("/", $this->request->get('_cover'));

            $filename = array_pop($segment);
            
            $path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR."storage/categories/".$filename;
            unlink($path);

        }

        
        $this->model->update([
            'id' => $this->request->get('id'),
            'name' => $this->request->get('name'), 
            'section_id' => $this->request->get('section_id'), 
            'cover' => $cover
        ]);
            
        $this->redirect('/admin/categories');
    }

    public function destroy($params)
    {
        extract($params);
        $this->model->delete($id);
        $this->redirect('/admin/categories');
    }
}