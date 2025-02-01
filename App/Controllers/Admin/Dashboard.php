<?php

namespace App\Controllers\Admin;

use App\Core\Http\{Response, BaseController, Request};
use App\Models\{User, Role};
use App\Core\Session;

class Dashboard extends BaseController
{
    protected string $layout = "admin";

    public $title;
    protected Response $response;
    protected $user;
    protected $role;

    public function __construct(private Request $request) {
        parent::__construct();
        $this->request = $request;
        $this->user = new User();
        $this->isGranted();
    }

    public function isGranted()
    {
        $userId = Session::instance()->get('userId');

        if($userId) {
            $user = $this->user->get($userId);
            $role = (new Role())->get($user->role_id); 
            if ($role->name == 'admin') {
                return true;
            }
            return $this->redirect('/profile');
        } 
        return $this->redirect('/login');
    }


    public function index(){
        $this->title = "Welcome to Admin dashboard";

        $body = $this->view()->render('admin/index', ['title' => $this->title]);
        
        $this->response = new Response($body);
        $this->response->send();
    }


}