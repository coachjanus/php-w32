<?php

namespace Controllers\Admin;

use Models\Role;
use Core\Http\{Request, BaseController};

class RoleController extends BaseController
{
   protected string $layout = "admin";
   protected $model;

   public function __construct(private Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->model = new Role();
    }

    public function index(){
        $roles = $this->model->selectAll();
        $title = "All roles";
        return $this->view()->render(view: 'admin/roles/index', context: compact('title',  'roles'));
    }

    public function create()
    {
        $title = "New role";
        return $this->view()->render(view: 'admin/roles/create', context: compact( 'title'));
    }

    public function store()
    {
        $this->model->insert(['name' => $this->request->get('name')]);
        return $this->redirect('/admin/roles');

        // try {
        //         $this->role->save(); 
        //         $this->request->flash()->message('success', 'Role created successfully!');
        //         $this->response->redirect('/admin/roles');
        // } catch(\Exception $e){
        //         $this->request->flash()->errors($e->getMessage());
        //         $this->response->back();
        // }
    }

    public function edit($params)
    {
        extract($param);
        $title = "Edit role";
        $role = $this->model->get($id);
        return $this->view()->render(view: 'admin/roles/edit', context: compact( 'title', 'role'));
    }

    public function update()
    {
        $this->model->update(['id' => $this->request->get('id'), 'name' => $this->request->get('name')]);

        return $this->redirect('/admin/roles');

            // if($role->save()){
            //     $this->request->session()->setFlash('success', 'Role updated successfully!');
            //     $this->response->redirect('/admin/roles');
            // }else {
            //     $this->request->session()->setFlash('danger', 'Some errors occurred!');
            // }
        
    }

    public function destroy($params)
    {
        extract($params);
        $this->model->delete($id);
        return $this->redirect('/admin/roles');
    }
}
