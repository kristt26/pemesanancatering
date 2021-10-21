<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'users';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id', 'username', 'password'];

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

    protected $encrypter;
    protected $db;

    public function __construct() {
        $this->encrypter = \Config\Services::encrypter();
        $this->db = \Config\Database::connect();
    }

    public function check()
    {
        if ($this->db->table('users')->countAllResults(false) == 0) {
            $this->db->transBegin();
            $user = [
                "username" => "Administrator",
                "password" => base64_encode($this->encrypter->encrypt("Admin")),
            ];
            $this->db->table('users')->insert($user);
            $userid = $this->db->insertID();
            $role = [
                "role" => "Admin",
            ];
            $this->db->table('roles')->insert($role);
            $roleid = $this->db->insertID();
            $roleuser = [
                'users_id' => $userid,
                'roles_id' => $roleid,
            ];
            $this->db->table('userinroles')->insert($roleuser);
            $role = [
                "role" => "Customer",
            ];
            $this->db->table('roles')->insert($role);
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return true;
            } else {
                $this->db->transCommit();
                return false;
            }
        }
    }

    public function login($data)
    {
        $username = $data['username'];
        $result = $this->db->query("SELECT
            `users`.`id`,
            `users`.`username`,
            `users`.`password`,
            `roles`.`role`
        FROM
            `users`
            LEFT JOIN `userinroles` ON `userinroles`.`users_id` = `users`.`id`
            LEFT JOIN `roles` ON `roles`.`id` = `userinroles`.`roles_id`,
            `pegawais` WHERE username='$username'")->getRowArray();
        if ($result) {
            $p = $this->encrypter->decrypt(base64_decode($result['password']));
            if ($p == $data['password']) {
                if($result['role']=='Customer'){
                    $item = $this->db->query("SELECT
                          `users`.`username`,
                            `users`.`password`,
                            `roles`.`role`,
                            `customers`.`nik`,
                            `customers`.`nama`,
                            `customers`.`alamat`,
                            `customers`.`kontak`,
                            `customers`.`users_id`,
                            `customers`.`id`
                    FROM
                        `users`
                        LEFT JOIN `userinroles` ON `userinroles`.`users_id` = `users`.`id`
                        LEFT JOIN `roles` ON `roles`.`id` = `userinroles`.`roles_id`
                        LEFT JOIN `customers` ON `users`.`id` = `customers`.`users_id` WHERE username='$username'")->getRowArray();
                    return $item;
                }else{
                    $result['nama'] = "Administrator";
                    return $result;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function insertUser($data)
    {
        $this->db->transBegin();
        $role = $this->db->table('role')->where('role', 'Pemesan')->get()->getRowArray();
        $this->db->table('user')->insert($data);
        $userid = $this->db->insertID();
        $userinrole = [
            'userid' => $userid,
            'roleid' => $role['id'],
        ];
        $this->db->table('userinrole')->insert($userinrole);
        if ($this->db->transStatus()) {
            $this->db->transCommit();
            return $userid;
        } else {
            $this->db->transRollback();
            return false;
        }
    }
}
