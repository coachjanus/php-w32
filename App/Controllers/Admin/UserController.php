<?php

namespace Controllers\Admin;

// use Core\{BaseController, Request, Rule, Validator};

use Core\Http\{Request, BaseController};
use Models\{Role, User};

use Core\Traits\Helpers;

class UserController extends BaseController
{
    use Helpers;

    protected string $layout = "admin";
    protected $model;

    private int $cost = 12;
    
    private User $user;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->model = new User();
    }

    public function index()
    {
        $users = $this->model->selectAll();
        $title = "All users";
        return $this->view()->render(view: 'admin/users/index', context: compact('title',  'users'));
    }

    public function create()
    {
        $title = "New user";
        $roles = (new Role())->selectAll();
        return $this->view()->render(view: 'admin/users/create', context: compact( 'title', 'roles'));
    }

    public function store()
    {
        $status = $this->request->get('status') ? 1 : 0;
        $password = $this->getHash($this->request->get('password'), $this->cost);


        $this->model->insert([
            'name' => $this->request->get('name'), 
            'email' => $this->request->get('email'), 
            'role_id' => $this->request->get('role_id'),
            'status' => $status,
            'password' => $password,

        
        ]);
        return $this->redirect('/admin/users');

        // try {
        //         $this->user->save(); 
        //         $this->request->flash()->message('success', 'User created successfully!');
        //         $this->response->redirect('/admin/users');
        // } catch(\Exception $e){
        //         $this->request->flash()->errors($e->getMessage());
        //         $this->response->back();
        // }

    }

    public function edit($params)
    {
        extract($params);
        
        $user = $this->user->first($id);
        $roles = (new Role())->select(['id', 'name'])->get();

        $this->response->render('admin/users/edit', compact('roles', 'user'));
    }

    public function update()
    {
        $this->user->id = $this->request->id;
        $this->user->name = $this->request->name;
        $this->user->email = $this->request->email;
        
        $this->user->role_id = $this->request->role_id;
        $this->user->status = $this->request->status ? 1 : 0;

     

        try {
            $this->user->save(); 
            $this->request->flash()->message('success', 'User updated successfully!');
            $this->response->redirect('/admin/users');
        } catch(\Exception $e){
                $this->request->flash()->errors($e->getMessage());
                $this->response->back();
        }

    }
}
