<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\AdminModel;
use App\Models\CatatanModel;
use App\Models\SettingModel;
use App\Models\DataguruModel;
use App\Models\KegiatanModel;
use App\Models\KelasModel;
use App\Models\NilaiModel;
use App\Models\SemesterModel;
use App\Models\SikapModel;
use App\Models\SiswaModel;
use App\Models\TahunModel;

class Laporan extends BaseController
{

  public function __construct()
  {
    $this->sekolah = new SettingModel();
    $this->wali = new DataguruModel();
    $this->semester = new SemesterModel();
    $this->tahun = new TahunModel();
    $this->nilai = new NilaiModel();
    $this->absen = new AbsenModel();
    $this->sikap = new SikapModel();
    $this->catatan = new CatatanModel();
    $this->kegiatan = new KegiatanModel();
    $this->admin = new AdminModel();
    $this->kelas = new KelasModel();
    $this->siswa = new SiswaModel();
  }

  public function index()
  {
    $id_admin = session()->get('id');
    $data = [
      'title'    => 'Kelas Siswa',
      'sub'      => 'Halaman Kelas Siswa',
      'sekolah'  => $this->sekolah->getData(),
      'kelas'    => $this->wali->getData(),
      'admin' => $this->admin->getData($id_admin)
    ];

    return view('admin/kelas_siswa', $data);
  }

  public function DataSiswa($id_kelas)
  {
    $id_admin = session()->get('id');
    $data = [
      'title'    => 'Input Data Semester',
      'sub'      => 'Halaman Input Data',
      'sekolah'  => $this->sekolah->getData(),
      'kelas'    => $this->wali->kelas($id_kelas),
      'semester' => $this->semester->findAll(),
      'tahun'    => $this->tahun->findAll(),
      'admin' => $this->admin->getData($id_admin)
    ];

    return view('admin/semester', $data);
  }

  public function getData()
  {
    $id_kelas = $this->request->getPost('kelas');
    $id_semester = $this->request->getPost('semester');
    $id_thn = $this->request->getPost('tahun');
    $id_admin = session()->get('id');
    $data = [
      'title'    => 'Data Semester',
      'sub'      => 'Halaman Data Semester',
      'sekolah'  => $this->sekolah->getData(),
      'kelas'    => $this->wali->kelas($id_kelas),
      'semester' => $this->semester->find($id_semester),
      'tahun' => $this->tahun->find($id_thn),
      'admin' => $this->admin->getData($id_admin)
    ];

    return view('admin/get_data_siswa', $data);
  }

  public function Siswa($id_kelas, $id_semester, $id_thn)
  {
    $id_admin = session()->get('id');
    $data = [
      'title'    => 'Data Kelas Siswa',
      'sub'      => 'Halaman Data Kelas Siswa',
      'sekolah'  => $this->sekolah->getData(),
      'kelas' => $this->kelas->find($id_kelas),
      'siswa'    => $this->wali->kelasSiswa($id_kelas),
      'semester' => $this->semester->find($id_semester),
      'tahun' => $this->tahun->find($id_thn),
      'admin' => $this->admin->getData($id_admin)
    ];

    return view('admin/datasiswa', $data);
  }

  public function lihat_nilai($id_siswa, $id_semester, $id_thn)
  {
    $carikelas = $this->siswa->kelas($id_siswa);
    $id_kelas = $carikelas['id_kelas'];
    $id_admin = session()->get('id');
    $data = [
      'title'   => 'Input Data Nilai',
      'sub'     => 'Halaman Input Nilai',
      'sekolah' => $this->sekolah->getData(),
      'siswa' => $carikelas,
      'walikelas' => $this->wali->kelas($id_kelas),
      'semester' => $this->semester->find($id_semester),
      'tahun' => $this->tahun->find($id_thn),
      'nilai' => $this->nilai->getNilai($id_siswa, $id_semester),
      'admin' => $this->admin->getData($id_admin)
    ];

    return view('admin/lihat_nilai', $data);
  }


  public function lihat_absen($id_siswa, $id_semester, $id_thn)
  {
    $carikelas = $this->siswa->kelas($id_siswa);
    $id_kelas = $carikelas['id_kelas'];
    $id_admin = session()->get('id');
    $data = [
      'title'   => 'Input Data Nilai',
      'sub'     => 'Halaman Input Nilai',
      'sekolah' => $this->sekolah->getData(),
      'siswa' => $carikelas,
      'walikelas' => $this->wali->kelas($id_kelas),
      'semester' => $this->semester->find($id_semester),
      'tahun' => $this->tahun->find($id_thn),
      'sikap'         => $this->sikap->getSikap($id_siswa, $id_semester),
      'absensi'   => $this->absen->getAbsen($id_siswa, $id_semester),
      'kegiatan' => $this->kegiatan->getKegiatan($id_siswa, $id_semester),
      'catatan' => $this->catatan->getCatatan($id_siswa, $id_semester),
      'ctt' => $this->catatan->get(),
      'admin' => $this->admin->getData($id_admin)
    ];

    return view('admin/lihat_absen', $data);
  }
}