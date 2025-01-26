<?php

namespace Controllers;

use Core\Http\{BaseController, Request};
use Core\{Rule, Validator, Session};
use Models\{User};
// use Core\Traits\Helpers;

class LoginController extends BaseController {
   protected string $layout = 'auth';
   public $isAuth = false;
   protected $model;

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
        return $this->view()->render(view: 'auth/login', context: compact('title'));
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
        $this->redirect('/login');
    }
    $this->redirect("/profile");
}

public function logout():bool   {
    $this->isAuth = false;
    Session::instance()->unset('userId');
    $this->redirect('/');   
}
}
