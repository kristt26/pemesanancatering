<?php

namespace App\Controllers\Customer;

// use App\Controllers\BaseController;
// use CodeIgniter\API\ResponseTrait;
use App\Libraries\Decode;
use CodeIgniter\RESTful\ResourceController;

class Pesanan extends ResourceController
{
    protected $modelName = 'App\Models\PesananModel';
    protected $format = 'json';
    protected $menu;
    protected $paket;
    protected $detailPaket;
    protected $pegawai;
    protected $detailPesanan;

    public function __construct() {
        $this->menu = new \App\Models\MenuModel();
        $this->paket = new \App\Models\PaketModel();
        $this->detailPaket = new \App\Models\DetailPaketModel();
        $this->pegawai = new \App\Models\PegawaiModel();
        $this->detailPesanan = new \App\Models\DetailPesananModel();
    }

    public function index()
    {
        $data['title'] = ["title" => "Pesanan", "sub" => ""];
        $data['content'] = view("customer/pesanan");
        $data['sidebar'] = view("layout/backend/sidebar", $data['title']);
        return view('layout/frontend/welcome', $data);
    }

    public function read()
    {
        $data['menu'] = $this->menu->findAll();
        $data['pesanan'] = $this->model->where('customers_id', session()->get('id'))->findAll();
        foreach ($data['pesanan'] as $key => $value) {
            $data['pesanan'][$key]['detail'] = $this->detailPesanan->where('pesanans_id', $value['id'])->findAll();
        }
        $data['paket'] = $this->paket->findAll();
        foreach ($data['paket'] as $key => $value) {
            $data['paket'][$key]['detail'] = $this->detailPaket->selectDetail($value['id']);
        }
        return $this->respond($data);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        $data->tanggal_pesan = date("Y-m-d");
        $data->customers_id = session()->get('id');
        $data->status_bayar = "Belum Bayar";
        $this->model->insert($data);
        $data->id = $this->model->getInsertID();
        foreach ($data->detail as $key => $value) {
            $value->pesanans_id = $data->id;
            $this->detailPesanan->insert($value);
            $value->id = $this->detailPesanan->getInsertID();
        }
        return $this->respondCreated($data, "disimpan");
    }

    public function put($id = null)
    {
        $decode = new Decode();
        $data = $this->request->getJSON();
        if (isset($data->foto->base64)) {
            try {
                $data->foto = $decode->decodebase64($data->foto->base64, 'makanan');
            } catch (\Throwable $th) {
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