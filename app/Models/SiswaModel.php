<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_siswa', 'nis', 'nisn', 'nama_siswa', 'agama', 'tgl_lahir', 'tempat_lahir', 'alamat', 'jenis_kelamin', 'id_kelas', 'id_kls', 'nama_ayah', 'nama_ibu', 'no_telepon'
    ];

    public function getData()
    {
        return $this->db->table('siswa')
            ->join('nm_kelas', 'nm_kelas.id_kelas=siswa.id_kelas')
            ->join('kelas', 'kelas.id_kls=siswa.id_kls')
            ->get()->getResultArray();
    }

    public function Data($id_siswa)
    {
        return $this->db->table('siswa')
            ->join('nm_kelas', 'nm_kelas.id_kelas=siswa.id_kelas')
            ->join('kelas', 'kelas.id_kls=siswa.id_kls')
            ->where('id_siswa', $id_siswa)
            ->get()->getResultArray();
    }

    public function kelas($id_siswa)
    {
        return $this->db->table('siswa')
            ->select('siswa.*,x1.*,x2.*')
            ->join('nm_kelas x1', 'x1.id_kelas=siswa.id_kelas')
            ->join('kelas x2', 'x2.id_kls=siswa.id_kls')
            ->where(['siswa.id_siswa' => $id_siswa])
            ->get()->getRowArray();
    }
}
