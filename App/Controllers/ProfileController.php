<?php
namespace Controllers;

// use Core\Interfaces\AuthInterface;
use Core\Http\{BaseController, Request};
use Core\{Session};
use Models\{User};

class ProfileController extends BaseController //implements AuthInterface
{

    protected string $layout = 'app';    

    protected $model;

    public function __construct(private Request $request){
        parent::__construct();
        $this->request = $request;
        $this->model = new User();

        $userId = Session::instance()->get('userId');

        // if($userId) {
        //     $this->user = (new User)->first($userId);
        // } 

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
        $title = 'Profile';
        // $user = $this->user;
        
        return $this->view()->render(view: 'auth/login', context: compact('title'));
    }


    // public function orders()
    // {
    //     $uid = $this->user->id;
    //     $orders = (new Order)->select()->where("user_id='$uid'")->get();
    //     $this->render('profile/orders', ['user' => $this->user, 'orders'=>$orders]);
    // }

}