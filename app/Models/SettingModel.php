<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sekolah';
    protected $primaryKey       = 'id_sekolah';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_sekolah', 'nama_sekolah', 'kepala_sekolah','nip_kepsek', 'alamat_sekolah', 'logo'
    ];

    public function getData()
    {
        return $this->db->table('sekolah')
			->get()
			->getRowArray();
    }
}
