<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $dataa['content'] = 5;
        return view('layout/backend/welcome', $dataa);
    }
}
