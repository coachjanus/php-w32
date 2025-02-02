<?php
namespace App\Controllers;

use App\Core\Http\{BaseController, Request, Response};
// use Core\Interfaces\AuthInterface;
use App\Core\{Session};
use App\Models\{User, Order};

class CartController extends BaseController //implements AuthInterface
{
    protected string $layout = 'app';    
    protected $model;
    protected User $user;
    protected $userId;
    private Response $response;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->model = new Order();
        $this->userId = Session::instance()->get('userId');
        
    }

    public function isGranted():bool
    {
        $this->userId = Session::instance()->get('userId');
        
        if(!$this->userId) {
            $this->redirect('/login');
        } 
        return true;
    }

    public function index()
    {
        $this->isGranted();
        $title = "Cart page";
        $content = $this->view()->render(view: 'shop/cart', context: compact(var_name: 'title'));

        $this->response = new Response($content);
        $this->response->send();
    }

    public function auth()
    {
        if($this->user) {
            echo json_encode($this->userId);
        } else {
            echo json_encode(false);
        } 
    }

    public function checkout()
    {
        $this->isGranted();

        // if (!$this->request->method() != 'POST') {
        //     throw new \Exception("Only POST requests are allowed!");
        // }

        // if (!$this->request->isJson()) {
        //     throw new \Exception("Content-Type must be application/json!");
        // }

        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        if (!is_array($decoded)) {
            throw new \Exception("Failed to decode json object!");
        }

        $productsInCart = json_encode($decoded['cart']);

        // $this->model->user_id = $this->user->get('id');
        // $this->model->products = $productsInCart;

        
        // $this->redirect('/admin/categories');
        header('Content-Type:application/json');
        try {
            // $sql = "INSERT INTO orders (user_id, products) VALUES (?, ?)";
            // $result = $this->model->insert($sql, [$this->user->id, $productsInCart]);
            $this->model = new Order();
            $result = $this->model->insert([
                'user_id' => $this->userId, 
                'products' => $productsInCart, 
            ]);

            var_export($result);




            $options = [
                'error' => false,
                'message' => "Everything OK",
                'result' => $result
            ];
            echo json_encode($options);
        } catch(\Exception $e) {
            $options = [
                'error' => true,
                'message' => $e->getMessage(),
                'result' => $result
            ];
            echo json_encode($options);
        }
    }

    public function orders() {
        $orders = $this->model->where("user_id=$this->userId")->all();

        $title = "My orders";
        $content = $this->view()->render(view: 'profile/orders', context: compact( 'title', 'orders'));

        $this->response = new Response($content);
        $this->response->send();

    }
}