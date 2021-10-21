<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
class Home extends ResourceController
{
    protected $menu;
    protected $paket;
    protected $detailPaket;
    protected $pegawai;
    public function __construct() {
        $this->menu = new \App\Models\MenuModel();
        $this->paket = new \App\Models\PaketModel();
        $this->detailPaket = new \App\Models\DetailPaketModel();
        $this->pegawai = new \App\Models\PegawaiModel();
    }
    public function index()
    {
        $data['menu'] = $this->menu->findAll();
        $data['pegawai'] = $this->pegawai->findAll();
        $data['title'] = ["title" => "Home", "sub" => ""];
        $data['content'] = "";
        return view('layout/frontend/layout', $data);
    }

    public function read($id = null)
    {
        $data['menu'] = $this->menu->findAll();
        $data['paket'] = $this->paket->findAll();
        foreach ($data['paket'] as $key => $value) {
            $data['paket'][$key]['detail'] = $this->detailPaket->selectDetail($value['id']);
        }
        $data['pegawai'] = $this->pegawai->findAll();
        return $this->respond($data);
    }

    public function post()
    {

    }

    public function put($id = null)
    {
        
    }

    public function delete($id = null)
    {

    }
}
