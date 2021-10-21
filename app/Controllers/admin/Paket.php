<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

class Paket extends ResourceController
{
    protected $modelName = 'App\Models\PaketModel';
    protected $format = 'json';
    protected $detailPaket;

    public function __construct()
    {
        $this->detailPaket = new \App\Models\DetailPaketModel();
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
                $paket = $this->model->findAll();
                foreach ($paket as $key => $value) {
                    $paket[$key]['detail'] =  $this->detailPaket->selectDetail($value['id']);
                }
                return $this->respond($paket);
            }
            return $this->respond($id);
        } catch (\Throwable $th) {
            if ($th->getCode() == 8) {
                return $this->fail("Periksa database anda");
            } else {
                return $this->fail($th->getMessage());
            }
        }
    }

    public function post()
    {
        $data = $this->request->getJSON();
        $item = [
            "nama_paket"=> $data->nama_paket,
            "harga"=> $data->harga,
            "porsi"=> $data->porsi,
            "keterangan"=> $data->keterangan,
        ];
        $this->model->insert($data);
        $item['id'] = $this->model->getInsertID();
        $item['detail'] = [];
        foreach ($data->detail as $key => $value) {
            $detail = [
                "paket_id"=>$item['id'],
                "menu_id"=>$value->id
            ];
            $this->detailPaket->insert($detail);
            $detail['id'] = $this->detailPaket->getInsertID();
            array_push($item['detail'], $detail);
        }
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

    public function deleteDetail($id = null)
    {
        return $this->respondDeleted($this->detailPaket->delete($id), "delete");
    }

    public function postDetail()
    {
        $data = $this->request->getJSON();
        $this->detailPaket->insert($data);
        $data->id = $this->detailPaket->getInsertID();
        return $this->respondCreated($data, "disimpan");
    }
}