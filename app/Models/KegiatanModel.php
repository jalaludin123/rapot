<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 't_kegiatan';
    protected $primaryKey       = 'id_kegiatan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kegiatan', 'id_siswa', 'id_semester', 'nama_kgt', 'predikat_kgt', 'keterangan_kgt', 'nama_prs', 'keterangan_prs'
    ];

    public function get()
    {
        return $this->db->table('t_kegiatan')
            ->join('siswa', 'siswa.id_siswa=t_kegiatan.id_siswa')
            ->join('semester', 'semester.id_semester=t_kegiatan.id_semester')
            ->get()->getResultArray();
    }

    public function getKegiatan($id_siswa, $id_semester)
    {
        return $this->db->table('t_kegiatan')
            ->select('t_kegiatan.*,x1.*,x2.semester')
            ->join('siswa x1', 'x1.id_siswa=t_kegiatan.id_siswa')
            ->join('semester x2', 'x2.id_semester=t_kegiatan.id_semester')
            ->where(['t_kegiatan.id_siswa' => $id_siswa])
            ->where(['t_kegiatan.id_semester' => $id_semester])
            ->get()->getResultArray();
    }
}