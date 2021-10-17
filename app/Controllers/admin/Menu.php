<?php

namespace App\Controllers\Admin;

// use App\Controllers\BaseController;
// use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Menu extends ResourceController
{
    protected $modelName = 'App\Models\MenuModel';
    protected $format    = 'json';

    public function index()
    {
        $data['title'] = ["title"=>"Menu Makanan", "sub"=>""];
        $data['content'] = view("admin/menu");
        $data['sidebar'] = view("layout/backend/sidebar", $data['title']);
        return view('layout/backend/welcome', $data);
    }

    public function read($id = null)
    {
        return $this->respond($id);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        $this->model->insert($data);
        $data->id = $this->model->getInsertID();
        return $this->respondCreated($data, "disimpan");
    }

    public function put($id = null)
    {
        $data = $this->request->getJSON();
        $this->model->update($id, $data);
        return $this->respondUpdated($data, "diubah");
    }

    public function delete($id = null)
    {
        
        return $this->respondDeleted($this->model->delete($id), "delete");
    }
}
