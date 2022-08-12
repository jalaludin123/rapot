<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'nm_kelas';
    protected $primaryKey       = 'id_kelas';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kelas', 'id_kls', 'kode_kelas', 'nama_kelas',
    ];

    public function getData()
    {
        return $this->db->table('nm_kelas')
            ->join('kelas', 'kelas.id_kls=nm_kelas.id_kls')
            ->get()->getResultArray();
    }

    public function Data($id_kelas)
    {
        return $this->db->table('siswa')
            ->where('id_kelas', $id_kelas)
            ->get()->getResultArray();
    }

    public function dataMapel($id_kls)
    {
        return $this->db->table('mapel')
            ->where('id_kls', $id_kls)
            ->get()->getResultArray();
    }
}