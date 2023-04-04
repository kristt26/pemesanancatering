<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    protected $user;
    protected $userinroles;
    protected $role;
    protected $customer;
    public function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
        $this->user = new \App\Models\UserModel();
        $this->userinroles = new \App\Models\UserRoleModel();
        $this->role = new \App\Models\RoleModel();
        $this->customer = new \App\Models\CustomersModel();
    }
    public function index()
    {
        $this->user->check();
        return view("login");
    }

    public function login()
    {
        $session = session();
        $data = (array) $this->request->getPost();
        $result = $this->model->login($data);
        if ($result) {
            $result['logged_in'] = true;
            $session->set($result);
            if ($result['role'] == 'Admin') {
                return redirect()->to('admin/home');
            } else {
                return redirect()->to('customer/home');
            }

        } else {
            return redirect()->back();
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_ur);
    }

    public function registrasi()
    {
        $role = $this->role->where('role', 'Customer')->first();
        $data = $this->request->getPost();
        if (count($data) > 0) {
            $pass = $data['password'];
            $data['password'] = base64_encode($this->encrypter->encrypt($pass));
            $this->user->insert($data);
            $data['users_id'] = $this->user->getInsertID();
            $this->customer->insert($data);
            $item = [
                "users_id" => $data['users_id'],
                "roles_id" => $role['id'],
            ];
            $this->userinroles->insert($item);
            return redirect()->to("/auth");
        } else {
            return view("registrasi");
        }
    }
}