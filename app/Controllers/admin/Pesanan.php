<?php

namespace App\Controllers\Admin;

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
    protected $pembayaran;
    protected $detailPesanan;

    public function __construct() {
        $this->menu = new \App\Models\MenuModel();
        $this->paket = new \App\Models\PaketModel();
        $this->detailPaket = new \App\Models\DetailPaketModel();
        $this->pembayaran = new \App\Models\PembayaranModel();
        $this->detailPesanan = new \App\Models\DetailPesananModel();
    }

    public function index()
    {
        $data['title'] = ["title" => "Pesanan", "sub" => ""];
        $data['content'] = view("admin/pesanan");
        $data['sidebar'] = view("layout/backend/sidebar", $data['title']);
        return view('layout/backend/welcome', $data);
    }

    public function read()
    {
        $data['menu'] = $this->menu->findAll();
        $data['pesanan'] = $this->model->findAll();
        foreach ($data['pesanan'] as $key => $value) {
            $data['pesanan'][$key]['detail'] = $this->detailPesanan->where('pesanans_id', $value['id'])->findAll();
            $data['pesanan'][$key]['pembayaran'] = $this->pembayaran->where('pesanans_id', $value['id'])->findAll();
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
        $data = $this->request->getJSON();
        $item = [
            "status_bayar"=>$data->status_bayar
        ];
        $this->model->update($id, $item);
        return $this->respondUpdated($data, "diubah");
    }

    public function delete($id = null)
    {

        return $this->respondDeleted($this->model->delete($id), "delete");
    }

    public function pembayaran()
    {
        $decode = new Decode();
        $data = $this->request->getJSON();
        if (isset($data->bukti)) {
            try {
                $data->bukti = $decode->decodebase64($data->bukti->base64, 'pembayaran');
                $data->pesanans_id = $data->id;
                $item = [
                    'status_bayar'=>"Proses"
                ];
                $this->model->update($data->id, $item);
                $data->status_bayar = $item['status_bayar'];
                $this->pembayaran->insert($data);
                $data->pembayaran = $this->pembayaran->where('pesanans_id', $data->id)->findAll();
                return $this->respondCreated($data, "disimpan");
            } catch (\Throwable $th) {
                $pesan = $th->getMessage();
                return $this->fail($pesan);
            }
        }

        
    }
}