<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use App\Models\DataguruModel;
use App\Models\NilaiModel;
use App\Models\AbsenModel;
use App\Models\SikapModel;
use App\Models\KegiatanModel;
use App\Models\CatatanModel;
use App\Models\KelasModel;
use App\Models\SemesterModel;
use App\Models\SiswaModel;
use App\Models\TahunModel;

class Rapot extends BaseController
{

    public function __construct()
    {
        $this->sekolah = new SettingModel();
        $this->wali = new DataguruModel();
        $this->nilai = new NilaiModel();
        $this->absen = new AbsenModel();
        $this->sikap = new SikapModel();
        $this->kegiatan = new KegiatanModel();
        $this->catatan = new CatatanModel();
        $this->semester = new SemesterModel();
        $this->tahun = new TahunModel();
        $this->kelas = new KelasModel();
        $this->siswa = new SiswaModel();
    }

    public function index()
    {
        $id_wali = session()->get('id');
        $data = [
            'title'    => 'Pilih Semester',
            'sub'      => 'Halaman Wali Kelas',
            'sekolah'  => $this->sekolah->getData(),
            'kelas'    => $this->wali->getData(),
            'semester' => $this->semester->findAll(),
            'tahun' => $this->tahun->findAll(),
            'users' => $this->wali->getWali($id_wali)
        ];

        return view('guru/cetak-rapot/kelas', $data);
    }

    public function getData()
    {
        $id_wali = session()->get('id');
        $id_kelas = $this->request->getPost('kelas');
        $id_semester = $this->request->getPost('semester');
        $id_thn = $this->request->getPost('tahun');

        $data = [
            'title'    => 'Data Semester',
            'sub'      => 'Halaman Wali Kelas',
            'sekolah'  => $this->sekolah->getData(),
            'kelas'    => $this->kelas->find($id_kelas),
            'semester' => $this->semester->find($id_semester),
            'tahun'   => $this->tahun->find($id_thn),
            'users' => $this->wali->getWali($id_wali)

        ];

        return view('guru/cetak-rapot/get_data_siswa', $data);
    }

    public function kelasSiswa($id_kelas, $id_semester, $id_thn)
    {
        $id_wali = session()->get('id');
        $data = [
            'title'    => 'Data Kelas Siswa',
            'sub'      => 'Halaman Data Kelas Siswa',
            'sekolah'  => $this->sekolah->getData(),
            'siswa'    => $this->wali->kelasSiswa($id_kelas),
            'semester' => $this->semester->find($id_semester),
            'tahun'   => $this->tahun->find($id_thn),
            'users' => $this->wali->getWali($id_wali)
        ];

        return view('guru/cetak-rapot/kelas-siswa', $data);
    }


    public function lihat($id_siswa, $id_semester, $id_thn)
    {
        $id_wali = session()->get('id');
        $data = [
            'title'    => 'Data Nilai Siswa',
            'sub'      => 'Halaman Input Nilai Siswa',
            'sekolah'  => $this->sekolah->getData(),
            'semester' => $this->semester->find($id_semester),
            'tahun'   => $this->tahun->find($id_thn),
            'siswa' => $this->siswa->kelas($id_siswa),
            'nilai'   => $this->nilai->getNilai($id_siswa, $id_semester),
            'users' => $this->wali->getWali($id_wali)

        ];

        return view('guru/cetak-rapot/lihat-nilai', $data);
    }

    public function lihat_absen($id_siswa, $id_semester, $id_thn)
    {
        $id_wali = session()->get('id');
        $data = [
            'title'    => 'Data Nilai Siswa',
            'sub'      => 'Halaman Input Nilai Siswa',
            'sekolah'  => $this->sekolah->getData(),
            'semester' => $this->semester->find($id_semester),
            'tahun'   => $this->tahun->find($id_thn),
            'siswa' => $this->siswa->kelas($id_siswa),
            'kegiatan'   => $this->kegiatan->getKegiatan($id_siswa, $id_semester),
            'sikap'   => $this->sikap->getSikap($id_siswa, $id_semester),
            'absensi'   => $this->absen->getAbsen($id_siswa, $id_semester),
            'catatan'   => $this->catatan->getCatatan($id_siswa, $id_semester),
            'users' => $this->wali->getWali($id_wali)

        ];

        return view('guru/cetak-rapot/lihat_absen', $data);
    }


    public function cetak($id_siswa, $id_semester, $id_thn)
    {
        $id_wali = session()->get('id');
        $data = [
            'siswa' => $this->nilai->Data($id_siswa),
            'tahun' => $this->tahun->find($id_thn),
            'semester' => $this->semester->find($id_semester),
            'setting' => $this->sekolah->getData(),
            'nilais' => $this->nilai->getNilai($id_siswa, $id_semester),
            'absens' => $this->absen->getAbsen($id_siswa, $id_semester),
            'catatan' => $this->catatan->getCatatan($id_siswa, $id_semester),
            'sikap' => $this->sikap->getSikap($id_siswa, $id_semester),
            'eskul' => $this->kegiatan->getKegiatan($id_siswa, $id_semester),
            'users'  => $this->wali->getWali($id_wali)
        ];

        return view('guru/cetak-rapot/rapot', $data);
    }
}