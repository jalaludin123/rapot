<?php

namespace App\Models;

use CodeIgniter\Model;

class DataguruModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'wali_kelas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'id_kelas', 'nama', 'email', 'password', 'nip', 'phone', 'foto', 'jk', 'level'
    ];

    public function getData()
    {
        return $this->db->table('wali_kelas')
            ->join('nm_kelas', 'nm_kelas.id_kelas=wali_kelas.id_kelas')
            ->get()->getResultArray();
    }

    public function getWali($id)
    {
        return $this->db->table('wali_kelas')
            ->join('nm_kelas', 'nm_kelas.id_kelas=wali_kelas.id_kelas')
            ->where(['id' => $id])
            ->get()->getRowArray();
    }

    public function kelas($id_kelas)
    {
        return $this->db->table('wali_kelas')
            ->select('wali_kelas.*, x1.*')
            ->join('nm_kelas x1', 'x1.id_kelas=wali_kelas.id_kelas')
            ->where(['wali_kelas.id_kelas' => $id_kelas])
            ->get()->getResultArray();
    }

    public function get($id_kelas)
    {
        return $this->db->table('wali_kelas')
            ->where('id_kelas', $id_kelas)
            ->get()->getResultArray();
    }

    public function data($id)
    {
        return $this->db->table('wali_kelas')
            ->join('nm_kelas', 'nm_kelas.id_kelas=wali_kelas.id_kelas')
            ->where('id', $id)
            ->get()->getRow();
    }

    public function kelasSiswa($id_kelas)
    {
        return $this->db->table('siswa')
            ->where('id_kelas', $id_kelas)
            ->get()->getResultArray();
    }
}