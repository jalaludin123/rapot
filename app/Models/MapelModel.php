<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mapel';
    protected $primaryKey       = 'id_mapel';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_mapel', 'id_kls', 'kode_mapel', 'nama_mapel'
    ];

    public function get()
    {
        return $this->db->table('mapel')
            ->join('kelas', 'kelas.id_kls=mapel.id_kls')
            ->get()->getResultArray();
    }

    public function dataMapel($id_kls)
    {
        return $this->db->table('mapel')
            ->where('id_kls', $id_kls)
            ->get()->getResultArray();
    }

    public function data($id_kls)
    {
        return $this->db->table('mapel')
            ->where('id_kls', $id_kls)
            ->get()->getRowArray();
    }
}