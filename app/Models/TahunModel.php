<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tahun';
    protected $primaryKey       = 'id_thn';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_thn', 'thn', 'thn_ajaran', 'status'
    ];

    public function get()
    {
        $this->db->table('tahun')
            ->get()->getResultArray();
    }

    public function get_tahun($id_thn)
    {
        $this->db->table('tahun')
            ->where('id_thn', $id_thn)
            ->get()->getRowArray();
    }

    public function resetStatus()
    {
        $this->db->table('tahun')
            ->update(['status' => 0]);
    }

    public function statusTa($id_thn)
    {
        return $this->db->table('tahun')
            ->where('id_thn', $id_thn)
            ->get()
            ->getRowArray();
    }
}