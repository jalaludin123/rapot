<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\SettingModel;
use App\Models\KlsModel;

class Siswa extends BaseController
{

    public function __construct()
    {
        $this->siswa        = new SiswaModel();
        $this->kelas        = new KelasModel();
        $this->sekolah      = new SettingModel();
        $this->kls = new KlsModel();
        $this->admin = new AdminModel();
    }
    public function index()
    {
        $id_admin = session()->get('id');
        $data = [
            'title'     => 'Data Siswa',
            'sub'       => 'Halaman Siswa',
            'kelas'     => $this->kelas->findAll(),
            'siswa'     => $this->siswa->getData(),
            'sekolah'   => $this->sekolah->getData(),
            'admin' => $this->admin->getData($id_admin)
        ];

        return view('admin/siswa/siswa', $data);
    }

    public function addsiswa()
    {
        $id_admin = session()->get('id');
        $data = [
            'title'     => 'Tambah Data Siswa',
            'sub'       => 'Halaman Siswa',
            'kelas'     => $this->kelas->findAll(),
            'kls'       => $this->kls->findAll(),
            'siswa'     => $this->siswa->getData(),
            'sekolah'   => $this->sekolah->getData(),
            'admin' => $this->admin->getData($id_admin)
        ];
        return view('admin/siswa/add_siswa', $data);
    }

    public function insert()
    {
        $input = $this->validate([
            'nama_siswa' => [
                'label'         => 'Nama Siswa',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'nis'          => [
                'label'         => 'Nis',
                'rules'         => 'required|is_unique[siswa.nis]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'nisn'          => [
                'label'         => 'Nisn',
                'rules'         => 'required|is_unique[siswa.nisn]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'tempat_lahir'  => [
                'label'     => 'Tempat Lahir',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'tgl_lahir'  => [
                'label'     => 'Tanggal Lahir',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'agama'  => [
                'label'     => 'Agama',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'nama_ayah'  => [
                'label'     => 'Nama Ayah',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'nama_ibu'  => [
                'label'     => 'Nama Ibu',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'no_telepon'  => [
                'label'     => 'Nomor Telepon',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'jenis_kelamin' => [
                'label'     => 'Jenis Kelamin',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'id_kls' => [
                'label'     => 'Kelas',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'id_kelas' => [
                'label'     => 'Nama Kelas',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong',
                ]
            ],
            'alamat'  => [
                'label'     => 'Alamat',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
        ]);
        if (!$input) {
            return redirect()->back()->withInput();
        } else {
            $data = $this->request->getPost();
            $this->siswa->insert($data);

            session()->setFlashdata("success", "Data Berhasil Di Tambahkan");
            return redirect()->to(base_url('admin/siswa'));
        }
    }

    public function update($id_siswa)
    {
        $id_admin = session()->get('id');
        $dataSiswa = $this->siswa->Data($id_siswa);
        if (empty($dataSiswa)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak Di Temukan');
        }
        $data = [
            'title'     => 'Edit Data Siswa',
            'sub'       => 'Halaman Siswa',
            'kelas'     => $this->kelas->findAll(),
            'kls'       => $this->kls->findAll(),
            'sekolah'   => $this->sekolah->getData(),
            'siswa'     => $dataSiswa,
            'admin' => $this->admin->getData($id_admin)
        ];
        return view('admin/siswa/edit_siswa', $data);
    }

    public function edit($id_siswa)
    {
        $dataLama = $this->siswa->find($this->request->getVar('id'));
        if ($dataLama['nis'] == $this->request->getPost('nis')) {
            $ruleNis = 'required';
        } else {
            $ruleNis = 'required|is_unique[siswa.nis]';
        }

        if ($dataLama['nisn'] == $this->request->getPost('nisn')) {
            $ruleNisn = 'required';
        } else {
            $ruleNisn = 'required|is_unique[siswa.nisn]';
        }
        $input = $this->validate([
            'nama_siswa' => [
                'label'         => 'Nama Siswa',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'nis'          => [
                'label'         => 'Nis',
                'rules'         => $ruleNis,
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'nisn'          => [
                'label'         => 'Nisn',
                'rules'         => $ruleNisn,
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'tempat_lahir'  => [
                'label'     => 'Tempat Lahir',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'tgl_lahir'  => [
                'label'     => 'Tanggal Lahir',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'agama'  => [
                'label'     => 'Agama',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'nama_ayah'  => [
                'label'     => 'Nama Ayah',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'nama_ibu'  => [
                'label'     => 'Nama Ibu',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'no_telepon'  => [
                'label'     => 'Nomor Telepon',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'jenis_kelamin' => [
                'label'     => 'Jenis Kelamin',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'id_kls' => [
                'label'     => 'Kelas',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'id_kelas' => [
                'label'     => 'Nama Kelas',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'alamat'  => [
                'label'     => 'Alamat',
                'rules'     => 'required',
                'errors'    => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
        ]);
        if (!$input) {
            return redirect()->back()->withInput();
        } else {
            $data = $this->request->getPost();

            $this->siswa->update($id_siswa, $data);
            session()->setFlashdata("edit", "Data Berhasil Di Edit");
            return redirect()->to(base_url('admin/siswa'));
        }
    }

    public function delate($id_siswa)
    {
        $this->siswa->find($id_siswa);

        $data = [
            'id_siswa' => $id_siswa
        ];

        $this->siswa->delete($data);

        session()->setFlashdata("hapus", "Data Berhasil Di Hapus");
        return redirect()->to(base_url('admin/siswa'));
    }

    public function detail($id_siswa)
    {
        $id_admin = session()->get('id');
        $data = [
            'title' => 'Detail Data Siswa',
            'sub'   => 'Halaman Detail Siswa',
            'siswaDetail'   => $this->siswa->Data($id_siswa),
            'sekolah'   => $this->sekolah->getData(),
            'admin' => $this->admin->getData($id_admin)
        ];
        return view('admin/siswa/detail_siswa', $data);
    }
}