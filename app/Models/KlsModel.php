<?php

namespace App\Models;

use CodeIgniter\Model;

class KlsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelas';
    protected $primaryKey       = 'id_kls';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kls', 'kls'
    ];

    public function get()
    {
        return $this->db->table('kelas')
            ->get()->getRow();
    }
}