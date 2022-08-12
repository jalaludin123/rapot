<?php

namespace App\Models;

use CodeIgniter\Model;

class SikapModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 't_sikap';
    protected $primaryKey       = 'id_sikap';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_sikap', 'id_siswa', 'id_semester', 'nama_sikap', 'predikat_sp', 'deskripsi_sp'
    ];

    public function get()
    {
        return $this->db->table('t_sikap')
            ->join('siswa', 'siswa.id_siswa=t_sikap.id_siswa')
            ->join('semester', 'semester.id_semester=t_sikap.id_semester')
            ->get()->getResultArray();
    }

    public function getSikap($id_siswa, $id_semester)
    {
        return $this->db->table('t_sikap')
            ->select('t_sikap.*,x1.*,x2.semester')
            ->join('siswa x1', 'x1.id_siswa=t_sikap.id_siswa')
            ->join('semester x2', 'x2.id_semester=t_sikap.id_semester')
            ->where(['t_sikap.id_siswa' => $id_siswa])
            ->where(['t_sikap.id_semester' => $id_semester])
            ->get()->getResultArray();
    }
}