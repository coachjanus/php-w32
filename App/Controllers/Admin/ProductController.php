<?php
namespace App\Controllers\Admin;

use App\Core\Http\{Request, BaseController, Response};

use App\Models\{Product, Brand, Badge, Category};
use App\Core\Traits\{Upload};


class ProductController extends BaseController
{
    use Upload;

    protected string $layout = "admin";
    protected $model;
    protected Response $response;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->model = new Product();
    }

    public function index()
    {
        $products = $this->model->selectAll();
        $title = "All products";

        $body = $this->view()->render(view: 'admin/products/index', context: compact('title',  'products'));

        $this->response = new Response($body);
        $this->response->send();
    }

    public function create()
    {
        $title = "New product";
        $categories = (new Category())->selectAll();
        
        $badges = (new Badge())->selectAll();
        $brands = (new Brand())->selectAll();
        
        $body = $this->view()->render(view: 'admin/products/create', context: compact( 'title', 'categories', 'badges', 'brands'));

        $this->response = new Response($body);
        $this->response->send();

    }
    public function store()
    {
        $cover = $this->request->get('image');
        $cover = $this->upload($cover, "storage/products");

        $status = $this->request->get('status')? 1 : 0;
        

        $this->model->insert([
            'name' => $this->request->get('name'), 
            'price' => $this->request->get('price'), 
            'description' => $this->request->get('description'), 
            'category_id' => $this->request->get('category_id'),
            'brand_id' => $this->request->get('brand_id'),
            'badge_id' => $this->request->get('badge_id'),
            'status' => $status,
            'image' => $cover 
        ]);
        $this->redirect('/admin/products');
    }

    public function edit($params)
    {
        extract($params);
        $title = "Edit product";
        $categories = (new Category())->selectAll();
        
        $badges = (new Badge())->selectAll();
        $brands = (new Brand())->selectAll();

        $product = $this->model->get($id);
        return $this->view()->render(view: 'admin/products/edit', context: compact( 'title', 'product', 'categories', 'badges', 'brands'));
    }

    public function update()
    {
        $this->product->id = $this->request->id;
        $this->product->name = $this->request->name;
        $this->product->category_id = $this->request->category_id;

        if($this->product->save()) {
            $this->redirect('/admin/products');
        } else {
            $this->redirect('/errors');
        }

    }
    public function show()
    {

    }
    public function destroy($params)
    {
        extract($params);
        if($_POST) {
            if ($this->product->delete($this->request->id)) {
                $this->redirect('/admin/products');
            } else {
                $this->redirect('/errors');
            }
        }

    }
}