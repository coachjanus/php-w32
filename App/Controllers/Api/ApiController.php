<?php declare(strict_types=1);

namespace App\Controllers\Api;

use App\Core\Http\{Request, JsonResponse};
use App\Models\{Product};

class ApiController
{
    // protected string $layout = "app";
    protected $model;

    public function __construct(private Request $request)
    {
        $this->model = new Product();
        $this->request = $request;
    }


    public function getProducts()
    {
        $products = $this->model->select([
            "products.*", 
            "categories.name as category", 
            "categories.id as categoryId", 
            "brands.name as brand", 
            "brands.id as brandId", 
            "badges.title as badge"
        ])
        ->join([
            "categories"=>"category_id", "brands"=>"brand_id", 
            "badges"=>"badge_id"
        ])->all();

        $response = new JsonResponse($products);
        header('Content-Type: application/json; charset=utf-8');
        // return $response;
        $response->send();
    }
}
