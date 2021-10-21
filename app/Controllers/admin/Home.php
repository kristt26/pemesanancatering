<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = ["title" => "Dashboard", "sub" => ""];
        $data['content'] = view("admin/home");
        $data['sidebar'] = view("layout/backend/sidebar", $data['title']);
        return view('layout/backend/welcome', $data);
    }
}
