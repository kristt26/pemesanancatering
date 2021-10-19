<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DetailPaket extends BaseController
{
    public function index()
    {
        //
    }

    public function read($id = null)
    {
        // $detail = new DetailPaket();
        // try {
        //     if (is_null($id)) {
        //         return $this->respond($this->model->findAll());
        //     }
        //     return $this->respond($id);
        // } catch (\Throwable$th) {
        //     if ($th->getCode() == 8) {
        //         return $this->fail("Periksa database anda");
        //     } else {
        //         return $this->fail($th->getMessage());
        //     }
        // }
        return "Data";

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