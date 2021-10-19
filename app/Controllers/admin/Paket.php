<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

class Paket extends ResourceController
{
    protected $modelName = 'App\Models\PakatModel';
    protected $format = 'json';
    protected $detailPaket;

    public function __construct()
    {
        $this->detailPaket = new \App\Models\DetailModel();
    }

    public function index()
    {
        $data['title'] = ["title" => "Paket Makanan", "sub" => ""];
        $data['content'] = view("admin/paket");
        $data['sidebar'] = view("layout/backend/sidebar", $data['title']);
        return view('layout/backend/welcome', $data);
    }

    public function read($id = null)
    {
        try {
            if (is_null($id)) {
                return $this->respond($this->model->findAll());
            }
            return $this->respond($id);
        } catch (\Throwable$th) {
            if ($th->getCode() == 8) {
                return $this->fail("Periksa database anda");
            } else {
                return $this->fail($th->getMessage());
            }
        }
    }

    public function post()
    {
        $decode = new Decode();
        $data = $this->request->getJSON();
        if (isset($data->foto)) {
            try {
                $data->foto = $decode->decodebase64($data->foto->base64, 'makanan');
            } catch (\Throwable$th) {
                return $this->fail($th);
            }
        }
        $this->model->insert($data);
        $data->id = $this->model->getInsertID();
        return $this->respondCreated($data, "disimpan");
    }

    public function put($id = null)
    {
        $data = $this->request->getJSON();
        if (isset($data->foto->base64)) {
            try {
                $data->foto = $decode->decodebase64($data->foto->base64, 'makanan');
            } catch (\Throwable$th) {
                return $this->fail($th->getMessage());
            }
        }
        $this->model->update($id, $data);
        return $this->respondUpdated($data, "diubah");
    }

    public function delete($id = null)
    {

        return $this->respondDeleted($this->model->delete($id), "delete");
    }
}