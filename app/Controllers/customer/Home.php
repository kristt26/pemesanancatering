<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = ["title" => "Home", "sub" => ""];
        $data['content'] = view("admin/home");
        $data['sidebar'] = view("layout/backend/sidebar", $data['title']);
        return view('layout/frontend/welcome', $data);
    }
}
