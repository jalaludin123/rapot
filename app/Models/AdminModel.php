<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{


    protected $DBGroup          = 'default';
    protected $table            = 'admin';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'nama', 'email', 'password', 'foto', 'level'
    ];


    public function getData($id)
    {
        return $this->db->table('admin')
            ->where(['id' => $id])
            ->get()->getRowArray();
    }

    public function get($id = null)
    {
        $this->db->table('user');
        if ($id != null) {
            $this->db->table('user')->where('id', $id);
        }
    }

    public function totalSiswa()
    {
        return $this->db->table('siswa')->countAllResults();
    }

    public function totalWaliKelas()
    {
        return $this->db->table('wali_kelas')->countAllResults();
    }

    public function totalKelas()
    {
        return $this->db->table('nm_kelas')->countAllResults();
    }

    public function totalMapel()
    {
        return $this->db->table('mapel')->countAllResults();
    }
}