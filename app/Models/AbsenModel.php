<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 't_absensi';
    protected $primaryKey       = 'id_hdr';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_hdr', 'id_siswa', 'id_semester', 'jenis_hdr', 'jumlah'
    ];

    public function get()
    {
        return $this->db->table('t_absensi')
            ->join('siswa', 'siswa.id_siswa=t_absensi.id_siswa')
            ->join('semester', 'semester.id_semester=t_absensi.id_semester')
            ->get()->getResultArray();
    }

    public function getAbsen($id_siswa, $id_semester)
    {
        return $this->db->table('t_absensi')
            ->select('t_absensi.*,x1.*,x2.semester')
            ->join('siswa x1', 'x1.id_siswa=t_absensi.id_siswa')
            ->join('semester x2', 'x2.id_semester=t_absensi.id_semester')
            ->where(['t_absensi.id_siswa' => $id_siswa])
            ->where(['t_absensi.id_semester' => $id_semester])
            ->get()->getResultArray();
    }
}