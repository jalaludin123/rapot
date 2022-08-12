<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use App\Models\DataguruModel;
use App\Models\NilaiModel;
use App\Models\SiswaModel;
use App\Models\SemesterModel;
use App\Models\TahunModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\AbsenModel;
use App\Models\SikapModel;
use App\Models\KegiatanModel;
use App\Models\CatatanModel;

class Nilai extends BaseController
{

  public function __construct()
  {
    $this->sekolah = new SettingModel();
    $this->wali = new DataguruModel();
    $this->nilai = new NilaiModel();
    $this->siswa = new SiswaModel();
    $this->semester = new SemesterModel();
    $this->tahun = new TahunModel();
    $this->mapel = new MapelModel();
    $this->kelas = new KelasModel();
    $this->absen = new AbsenModel();
    $this->sikap = new SikapModel();
    $this->kegiatan = new KegiatanModel();
    $this->catatan = new CatatanModel();
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

    return view('guru/input_nilai/kelas', $data);
  }

  public function dataSemester()
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
      'ta'  => $this->tahun->statusTa($id_thn),
      'users' => $this->wali->getWali($id_wali)

    ];

    return view('guru/input_nilai/data_semester', $data);
  }

  public function siswa($id_kelas, $id_semester, $id_thn)
  {
    $id_wali = session()->get('id');
    $data = [
      'title'    => 'Data Kelas Siswa',
      'sub'      => 'Halaman Data Kelas Siswa',
      'sekolah'  => $this->sekolah->getData(),
      'kelas'    => $this->wali->kelasSiswa($id_kelas),
      'semester' => $this->semester->find($id_semester),
      'tahun'   => $this->tahun->find($id_thn),
      'users' => $this->wali->getWali($id_wali)
    ];

    return view('guru/input_nilai/siswa_kelas', $data);
  }


  public function inputNilai($id_siswa, $id_semester, $id_thn)
  {
    $id_wali = session()->get('id');
    $kelas_mapel = $this->siswa->kelas($id_siswa);
    $id_kls = $kelas_mapel['id_kls'];
    $cek = $this->nilai->getSemester($id_semester, $id_siswa);
    $cekData = isset($cek['id_semester']) ? $cek['id_semester'] : '';
    $data = [
      'title'    => 'Data Nilai Siswa',
      'sub'      => 'Halaman Input Nilai Siswa',
      'sekolah'  => $this->sekolah->getData(),
      'semester' => $this->semester->find($id_semester),
      'tahun'   => $this->tahun->find($id_thn),
      'siswa' => $this->siswa->kelas($id_siswa),
      'mapel'      => $this->mapel->dataMapel($id_kls),
      'nilai'   => $this->nilai->getNilai($id_siswa, $id_semester),
      'getSemester' => $cekData,
      'users' => $this->wali->getWali($id_wali)

    ];

    return view('guru/input_nilai/nilai', $data);
  }

  public function save_nilai()
  {
    $id_kls = $this->request->getPost('kls');
    $id_siswa = $this->request->getPost('siswa');
    $id_semester = $this->request->getPost('semester');
    $id_thn = $this->request->getPost('tahun');
    foreach ($this->mapel->dataMapel($id_kls) as $row) {
      $this->nilai->insert([
        'id_siswa' => $this->request->getPost('id_siswa' . $row['id_mapel']),
        'kelas' => $this->request->getPost('nama_kelas' . $row['id_mapel']),
        'id' => $this->request->getPost('id' . $row['id_mapel']),
        'id_mapel' => $this->request->getPost('id_mapel' . $row['id_mapel']),
        'id_thn' => $this->request->getPost('id_thn' . $row['id_mapel']),
        'id_semester' => $this->request->getPost('id_semester' . $row['id_mapel']),
        'kkm' => $this->request->getPost('kkm' . $row['id_mapel']),
        'nilai_tgs' => $this->request->getPost('tp1' . $row['id_mapel']),
        'nilai_nu' => $this->request->getPost('tp2' . $row['id_mapel']),
        'nilai_pts' => $this->request->getPost('tp3' . $row['id_mapel']),
        'nilai_pas' => $this->request->getPost('tp4' . $row['id_mapel']),
        'nilai' => $this->request->getPost('rata_tp' . $row['id_mapel']),
        'predikat' => $this->request->getPost('predikat' . $row['id_mapel']),
        'deskripsi' => $this->request->getPost('deskripsi' . $row['id_mapel'])
      ]);
    }
    session()->setFlashdata('berhasil', 'Data Berhasil Ditambahkan');
    return redirect()->to('guru/nilai/inputNilai/' . $id_siswa . '/' . $id_semester . '/' . $id_thn);
  }

  public function updateNilai($id_siswa)
  {
    $id_semester = $this->request->getPost('id_semester');
    $id_thn = $this->request->getPost('id_thn');
    $id_siswa = $this->request->getPost('id_siswa');
    foreach ($this->nilai->getNilai($id_siswa, $id_semester) as $nilai) {
      $idnilai = $this->request->getPost('id_nilai' . $nilai['id_mapel']);
      $data = [
        'kkm' => $this->request->getPost('kkm' . $nilai['id_mapel']),
        'nilai_tgs' => $this->request->getPost('tp1' . $nilai['id_mapel']),
        'nilai_nu' => $this->request->getPost('tp2' . $nilai['id_mapel']),
        'nilai_pts' => $this->request->getPost('tp3' . $nilai['id_mapel']),
        'nilai_pas' => $this->request->getPost('tp4' . $nilai['id_mapel']),
        'nilai' => $this->request->getPost('rata_tp' . $nilai['id_mapel']),
        'predikat' => $this->request->getPost('predikat' . $nilai['id_mapel']),
        'deskripsi' => $this->request->getPost('deskripsi' . $nilai['id_mapel'])
      ];
      $this->nilai->update($idnilai, $data);
    }
    session()->setFlashdata("edit", "Data Berhasil Di Edit");
    return redirect()->to(base_url('guru/nilai/inputNilai/' . $id_siswa . '/' . $id_semester . '/' . $id_thn));
  }


  public function inputData($id_siswa, $id_semester, $id_thn)
  {
    $id_wali = session()->get('id');
    $cek = $this->nilai->getSemester($id_semester, $id_siswa);
    $cekData = isset($cek['id_semester']) ? $cek['id_semester'] : '';
    $data = [
      'title'    => 'Data Siswa',
      'sub'      => 'Halaman Input Data Siswa',
      'sekolah'  => $this->sekolah->getData(),
      'semester' => $this->semester->find($id_semester),
      'tahun'   => $this->tahun->find($id_thn),
      'siswa' => $this->siswa->kelas($id_siswa),
      'sikap'         => $this->sikap->getSikap($id_siswa, $id_semester),
      'absensi'   => $this->absen->getAbsen($id_siswa, $id_semester),
      'kegiatan' => $this->kegiatan->getKegiatan($id_siswa, $id_semester),
      'catatan' => $this->catatan->getCatatan($id_siswa, $id_semester),
      'getSemester' => $cekData,
      'users' => $this->wali->getWali($id_wali)

    ];

    return view('guru/input_nilai/data_absen', $data);
  }

  public function Sikap()
  {
    $id_wali = session()->get('id');
    $id_siswa =  $this->request->getPost('siswa');
    $id_semester = $this->request->getPost('semester');
    $id_thn = $this->request->getPost('tahun');

    $input = $this->validate([
      'nama_sikap'          => [
        'label'         => 'Nama Sikap',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ],
      'predikat_sp'          => [
        'label'         => 'Predikat Sikap',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ],
      'deskripsi_sp'          => [
        'label'         => 'Deskripsi Sikap',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ],
    ]);
    if (!$input) {
      return redirect()->back()->withInput();
    } else {
      $data = [
        'id_siswa'      => $id_siswa,
        'id_semester'      => $id_semester,
        'nama_sikap'      => $this->request->getPost('nama_sikap'),
        'predikat_sp'      => $this->request->getPost('predikat_sp'),
        'deskripsi_sp'      => $this->request->getPost('deskripsi_sp'),
        'users'  => $this->wali->getWali($id_wali)
      ];

      $this->sikap->insert($data);
      session()->setFlashdata('berhasil', 'Data Sikap Berhasil Ditambahkan');
      return redirect()->to('guru/nilai/inputData/' . $id_siswa . '/' . $id_semester . '/' . $id_thn);
    }
  }

  public function Absen()
  {
    $id_wali = session()->get('id');
    $id_siswa =  $this->request->getPost('siswa');
    $id_semester = $this->request->getPost('semester');
    $id_thn = $this->request->getPost('tahun');

    $input = $this->validate([
      'jenis_hdr'          => [
        'label'         => 'Nama Ketidakhadiran',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ],
      'jumlah'          => [
        'label'         => 'Jumlah Ketidakhadiran',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ]
    ]);
    if (!$input) {
      return redirect()->back()->withInput();
    } else {

      $data = [
        'id_siswa'      => $id_siswa,
        'id_semester'      => $id_semester,
        'jenis_hdr'      => $this->request->getPost('jenis_hdr'),
        'jumlah'      => $this->request->getPost('jumlah'),
        'users'  => $this->wali->getWali($id_wali)
      ];

      $this->absen->insert($data);
      session()->setFlashdata('berhasil', 'Data Absensi Berhasil Ditambahkan');
      return redirect()->to('guru/nilai/inputData/' . $id_siswa . '/' . $id_semester . '/' . $id_thn);
    }
  }

  public function Kegiatan()
  {
    $id_wali = session()->get('id');
    $id_siswa =  $this->request->getPost('siswa');
    $id_semester = $this->request->getPost('semester');
    $id_thn = $this->request->getPost('tahun');

    $input = $this->validate([
      'nama_kgt'          => [
        'label'         => 'Nama Kegiatan',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ],
      'predikat_kgt'          => [
        'label'         => 'Predikat Kegiatan',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ],
      'keterangan_kgt'          => [
        'label'         => 'Keterangan Kegiatan',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ],
      'nama_prs'          => [
        'label'         => 'Nama Prestasi',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ],
      'keterangan_prs'          => [
        'label'         => 'Keterangan Prestasi',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ],
    ]);
    if (!$input) {
      return redirect()->back()->withInput();
    } else {

      $data = [
        'id_siswa'      => $id_siswa,
        'id_semester'      => $id_semester,
        'nama_kgt'      => $this->request->getPost('nama_kgt'),
        'predikat_kgt'      => $this->request->getPost('predikat_kgt'),
        'keterangan_kgt'      => $this->request->getPost('keterangan_kgt'),
        'nama_prs'      => $this->request->getPost('nama_prs'),
        'keterangan_prs'      => $this->request->getPost('keterangan_prs'),
        'users'  => $this->wali->getWali($id_wali)
      ];

      $this->kegiatan->insert($data);
      session()->setFlashdata('berhasil', 'Data Kegiatan Berhasil Ditambahkan');
      return redirect()->to('guru/nilai/inputData/'  . $id_siswa . '/' . $id_semester . '/' . $id_thn);
    }
  }

  public function Catatan()
  {
    $id_wali = session()->get('id');
    $id_siswa =  $this->request->getPost('siswa');
    $id_semester = $this->request->getPost('semester');
    $id_thn = $this->request->getPost('tahun');

    $input = $this->validate([
      'catatan'          => [
        'label'         => 'Catatan Wali Kelas',
        'rules'         => 'required',
        'errors'        => [
          'required'  => '{field} Tidak Boleh Kosong'
        ]
      ]
    ]);
    if (!$input) {
      return redirect()->back()->withInput();
    } else {
      $data = [
        'id_siswa'      =>  $id_siswa,
        'id_semester'      => $id_semester,
        'catatan'      => $this->request->getPost('catatan'),
        'users'  => $this->wali->getWali($id_wali)
      ];

      $this->catatan->insert($data);
      session()->setFlashdata('berhasil', 'Data Catatan Wali Kelas Berhasil Ditambahkan');
      return redirect()->to('guru/nilai/inputData/' . $id_siswa . '/' . $id_semester . '/' . $id_thn);
    }
  }

  public function hapus_catatan($id_catatan, $id_siswa, $id_semester, $id_thn)
  {
    $this->catatan->find($id_catatan);
    $data = [
      'id_catatan' => $id_catatan
    ];

    $this->catatan->delete($data);

    session()->setFlashdata("hapus", "Data Catatan Wali Kelas Berhasil Di Hapus");
    return redirect()->to(base_url('guru/nilai/inputData/' . $id_siswa . '/' . $id_semester . '/' . $id_thn));
  }

  public function hapus_absen($id_hdr, $id_siswa, $id_semester, $id_thn)
  {
    $this->absen->find($id_hdr);
    $data = [
      'id_hdr' => $id_hdr
    ];

    $this->absen->delete($data);

    session()->setFlashdata("hapus", "Data Absen Berhasil Di Hapus");
    return redirect()->to(base_url('guru/nilai/inputData/' . $id_siswa . '/' . $id_semester . '/' . $id_thn));
  }

  public function hapus_sikap($id_sikap, $id_siswa, $id_semester, $id_thn)
  {
    $this->sikap->find($id_sikap);
    $data = [
      'id_sikap' => $id_sikap
    ];

    $this->sikap->delete($data);

    session()->setFlashdata("hapus", "Data Sikap Berhasil Di Hapus");
    return redirect()->to(base_url('guru/nilai/inputData/' . $id_siswa . '/' . $id_semester . '/' . $id_thn));
  }

  public function hapus_kegiatan($id_kegiatan, $id_siswa, $id_semester, $id_thn)
  {
    $this->kegiatan->find($id_kegiatan);
    $data = [
      'id_kegiatan' => $id_kegiatan
    ];

    $this->kegiatan->delete($data);

    session()->setFlashdata("hapus", "Data Kegiatan Siswa Berhasil Di Hapus");
    return redirect()->to(base_url('guru/nilai/inputData/' . $id_siswa . '/' . $id_semester . '/' . $id_thn));
  }
}