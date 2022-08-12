<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'nilai';
    protected $primaryKey       = 'id_nilai';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_nilai', 'id', 'id_siswa', 'id_semester', 'id_thn', 'id_mapel', 'kelas', 'nilai_tgs', 'nilai_nu', 'nilai_pts', 'nilai_pas', 'nilai', 'kkm', 'deskripsi', 'predikat'
    ];

    public function getSiswa($id_siswa)
    {
        return $this->db->table('nilai')
            ->select('nilai.*,x1.*,x2.nama,x2.nip,x4.thn_ajaran,x5.semester,x7.nama_mapel,x7.kode_mapel')
            ->join('siswa x1', 'x1.id_siswa=nilai.id_siswa')
            ->join('wali_kelas x2', 'x2.id=nilai.id')
            ->join('tahun x4', 'x4.id_thn=nilai.id_thn')
            ->join('semester x5', 'x5.id_semester=nilai.id_semester')
            ->join('mapel x7', 'x7.id_mapel=nilai.id_mapel')
            ->where(['nilai.id_siswa' => $id_siswa])
            ->get(1)->getResultArray();
    }

    public function get()
    {
        return $this->db->table('nilai')
            ->join('siswa x1', 'x1.id_siswa=nilai.id_siswa')
            ->join('wali_kelas x2', 'x2.id=nilai.id')
            ->join('tahun x4', 'x4.id_thn=nilai.id_thn')
            ->join('semester x5', 'x5.id_semester=nilai.id_semester')
            ->join('mapel x7', 'x7.id_mapel=nilai.id_mapel')
            ->get()->getRowArray();
    }

    public function getNilai($id_siswa, $id_semester)
    {
        return $this->db->table('nilai')
            ->select('nilai.*,x1.*,x2.nama,x2.nip,x4.thn_ajaran,x5.semester,x7.nama_mapel,x7.kode_mapel')
            ->join('siswa x1', 'x1.id_siswa=nilai.id_siswa')
            ->join('wali_kelas x2', 'x2.id=nilai.id')
            ->join('tahun x4', 'x4.id_thn=nilai.id_thn')
            ->join('semester x5', 'x5.id_semester=nilai.id_semester')
            ->join('mapel x7', 'x7.id_mapel=nilai.id_mapel')
            ->where(['nilai.id_siswa' => $id_siswa])
            ->where(['nilai.id_semester' => $id_semester])
            ->get()->getResultArray();
    }

    public function Nilai($id_nilai, $id_siswa, $id_semester)
    {
        return $this->db->table('nilai')
            ->select('nilai.*,x1.*,x2.nama,x2.nip,x4.thn_ajaran,x5.semester,x7.nama_mapel,x7.kode_mapel')
            ->join('siswa x1', 'x1.id_siswa=nilai.id_siswa')
            ->join('wali_kelas x2', 'x2.id=nilai.id')
            ->join('tahun x4', 'x4.id_thn=nilai.id_thn')
            ->join('semester x5', 'x5.id_semester=nilai.id_semester')
            ->join('mapel x7', 'x7.id_mapel=nilai.id_mapel')
            ->where(['nilai.id_nilai' => $id_nilai])
            ->where(['nilai.id_siswa' => $id_siswa])
            ->where(['nilai.id_semester' => $id_semester])
            ->get()->getResultArray();
    }

    public function getSemester($id_semester, $id_siswa)
    {
        return $this->db->table('nilai')
            ->select('nilai.*,x1.*,x2.nama,x2.nip,x4.thn_ajaran,x5.semester,x7.nama_mapel,x7.kode_mapel')
            ->join('siswa x1', 'x1.id_siswa=nilai.id_siswa')
            ->join('wali_kelas x2', 'x2.id=nilai.id')
            ->join('tahun x4', 'x4.id_thn=nilai.id_thn')
            ->join('semester x5', 'x5.id_semester=nilai.id_semester')
            ->join('mapel x7', 'x7.id_mapel=nilai.id_mapel')
            ->where(['nilai.id_semester' => $id_semester])
            ->where(['nilai.id_siswa' => $id_siswa])
            ->get()->getRowArray();
    }

    public function dataMapel($id_kls)
    {
        return $this->db->table('mapel')
            ->where('id_kls', $id_kls)
            ->get()->getResultArray();
    }

    public function Data($id_siswa)
    {
        return $this->db->table('siswa')
            ->join('nm_kelas', 'nm_kelas.id_kelas=siswa.id_kelas')
            ->join('kelas', 'kelas.id_kls=siswa.id_kls')
            ->where('id_siswa', $id_siswa)
            ->get()->getRowArray();
    }
    // public function cek($id_siswa, $id, $id_kelas, $id_nilai)

}