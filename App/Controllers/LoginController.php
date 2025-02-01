<?php

namespace App\Controllers;

use App\Core\Http\{BaseController, Request, Response};
use App\Core\{Rule, Validator, Session};
use App\Models\{User};
// use Core\Traits\Helpers;

class LoginController extends BaseController {
   protected string $layout = 'auth';
   public $isAuth = false;
   protected $model;
   private Response $response;

    public function __construct(private Request $request)
    {
            parent::__construct();
            $this->request = $request;
            $this->model = new User();

            $this->isAuth = $this->isLogged();
    }
    public function isLogged():bool   {
        if (Session::instance()->get('userId')) {
            return true;
        }
        return false;
    }
    public function checkCookie():array    {
        return [false, null];
    }
    protected function getUser(string $email)    {
        return $this->model->findBy("email='$email'");
    }
    public function index()   {
        $title = "Sign in";
        if ($this->isAuth) {
            $this->redirect('/profile');   
            
        } else {
            $content = $this->view()->render(view: 'auth/login', context: compact('title'));

            $this->response = new Response($content);
            $this->response->send();
        }
    }

    function signin()   {
        $user = $this->getUser($this->request->get('email'));
        if ($user) {
            if (password_verify($this->request->get('password'), $user->password)) {
                $this->isAuth = true;
                Session::instance()->set('userId', $user->id);
            }
        } else {
            // $this->request->flash()->message('danger', 'Email address or password are incorrect.');
            return $this->redirect('/login');
        }
        return $this->redirect("/profile");
    }

    public function logout()  {
        $this->isAuth = false;
        Session::instance()->unset('userId');
        return $this->redirect('/');   
    }
}
