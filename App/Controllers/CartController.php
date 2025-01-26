<?php
namespace Controllers;

use Core\Http\{BaseController, Request,Response};
// use Core\Interfaces\AuthInterface;
use Core\{Session};
use Models\{User, Order};

class CartController extends BaseController //implements AuthInterface
{
    protected string $layout = 'app';    
    protected $model;
    protected User $user;
    protected $userId;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->model = new Order();

        $this->userId = Session::instance()->get('userId');
        
        if($this->userId) {
            $this->user = (new User)->get($this->userId);
        } 

        // $this->isGranted();
    }

    public function isGranted(string $name = 'customer'):bool
    {
        if (!$this->user) {
            $this->redirect('/login');
        }
        return true;
    }

    public function index()
    {
        $title = "Cart page";
        return (new Response($this->view()->render(view: 'cart', context: compact(var_name: 'title'))))->send();
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
        if (!$this->user) {
            $this->redirect('/login');
        }

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
            $result = $this->model->insert([
                'user_id' => $this->userId, 
                'products' => $productsInCart, 
            ]);

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
}