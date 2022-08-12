<?php

namespace App\Models;

use CodeIgniter\Model;

class CatatanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 't_catatan';
    protected $primaryKey       = 'id_catatan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_catatan', 'id_siswa', 'id_kelas', 'id_semester', 'catatan'
    ];

    public function get()
    {
        return $this->db->table('t_catatan')
            ->join('siswa', 'siswa.id_siswa=t_catatan.id_siswa')
            ->join('semester', 'semester.id_semester=t_catatan.id_semester')
            ->get()->getRowArray();
    }

    public function getCatatan($id_siswa, $id_semester)
    {
        return $this->db->table('t_catatan')
            ->select('t_catatan.*,x1.*,x2.semester')
            ->join('siswa x1', 'x1.id_siswa=t_catatan.id_siswa')
            ->join('semester x2', 'x2.id_semester=t_catatan.id_semester')
            ->where(['t_catatan.id_siswa' => $id_siswa])
            ->where(['t_catatan.id_semester' => $id_semester])
            ->get()->getRowArray();
    }
}