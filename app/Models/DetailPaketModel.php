<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPaketModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'detail_paket';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id', 'paket_id', 'menu_id'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    public function selectDetail($paket_id)
    {
        $result = $this->db->query("SELECT
            `detail_paket`.`id`,
            `detail_paket`.`paket_id`,
            `detail_paket`.`menu_id`,
            `menus`.`menu`,
            `menus`.`satuan`,
            `menus`.`harga`,
            `menus`.`foto`,
            `menus`.`jenis`
        FROM
            `detail_paket`
            LEFT JOIN `menus` ON `menus`.`id` = `detail_paket`.`menu_id`
        WHERE `detail_paket`.`paket_id`= '$paket_id'")->getResultArray();
        return $result;
    }
}