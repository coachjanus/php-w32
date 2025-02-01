<?php
namespace App\Controllers;

// use Core\Interfaces\AuthInterface;
use App\Core\Http\{BaseController, Request, Response};
use App\Core\{Session};
use App\Models\{User};

class ProfileController extends BaseController //implements AuthInterface
{

    protected string $layout = 'app';    


    protected $model;
    private Response $response;
    private User $user;

    public function __construct(private Request $request){
        parent::__construct();
        $this->request = $request;
        $this->model = new User();
        $this->isGranted();

    }


    public function isGranted()
    {
        $userId = Session::instance()->get('userId');
        if (!$userId) {
            return $this->redirect('/login');
        }
        return true;
    }

    public function index()
    {
        $title = 'Wellcome back';

        $userId = Session::instance()->get('userId');

        if($userId) {
            $user = $this->model->get($userId);
            // var_export($user);
        } 

        
        $content = $this->view()->render(view: 'profile/index', context: compact('title', 'user'));


        $this->response = new Response($content);
        $this->response->send();
    }


    // public function orders()
    // {
    //     $uid = $this->user->id;
    //     $orders = (new Order)->select()->where("user_id='$uid'")->get();
    //     $this->render('profile/orders', ['user' => $this->user, 'orders'=>$orders]);
    // }

}