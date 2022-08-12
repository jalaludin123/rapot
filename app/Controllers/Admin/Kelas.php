<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\KelasModel;
use App\Models\SettingModel;
use App\Models\KlsModel;

class Kelas extends BaseController
{

    public function __construct()
    {
        $this->kelas = new KelasModel();
        $this->sekolah = new SettingModel();
        $this->kls = new KlsModel();
        $this->admin = new AdminModel();
    }

    // Source Code Tampilan Halaman Awal Kelas
    public function index()
    {
        $id_admin = session()->get('id');
        $data = [
            'title' => 'Kelas',
            'sub'   => 'Halaman Kelas',
            'kls'   => $this->kls->findAll(),
            'kelas' => $this->kelas->getData(),
            'sekolah'   => $this->sekolah->getData(),
            'admin' => $this->admin->getData($id_admin)
        ];

        return view('admin/kelas', $data);
    }

    // Source Code Tampilan Halaman Tambah Data Kelas
    public function insert()
    {
        $input = $this->validate([
            'kode_kelas'          => [
                'label'         => 'Kode Kelas',
                'rules'         => 'required|is_unique[nm_kelas.kode_kelas]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'nama_kelas'          => [
                'label'         => 'Nama Kelas',
                'rules'         => 'required|is_unique[nm_kelas.nama_kelas]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ]
        ]);
        if (!$input) {
            return redirect()->to('admin/kelas')->withInput();
        } else {
            $data = $this->request->getPost();
            $this->kelas->insert($data);

            session()->setFlashdata("success", "Data Berhasil Di Tambahkan");
            return redirect()->to(base_url('admin/kelas'));
        }
    }

    // Source Code Tampilan Halaman Edit Data Kelas 
    public function edit($id_kelas)
    {
        $dataLama = $this->kelas->find($this->request->getVar('id'));
        if ($dataLama['nama_kelas'] == $this->request->getPost('nama_kelas')) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[nm_kelas.nama_kelas]';
        }
        $input = $this->validate([
            'nama_kelas'          => [
                'label'         => 'Nama Kelas',
                'rules'         => $rule,
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ]
        ]);
        if (!$input) {
            return redirect()->to('admin/kelas')->withInput();
        } else {
            $data = $this->request->getPost();

            $this->kelas->update($id_kelas, $data);
            session()->setFlashdata("edit", "Data Berhasil Di Edit");
            return redirect()->to(base_url('admin/kelas'));
        }
    }

    // Source Code Tampilan Halaman Hapus Data Kelas
    public function delate($id_kelas)
    {
        $this->kelas->find($id_kelas);

        $data = [
            'id_kelas' => $id_kelas
        ];

        $this->kelas->delete($data);

        session()->setFlashdata("hapus", "Data Berhasil Di Hapus");
        return redirect()->to(base_url('admin/kelas'));
    }

    public function kelasSiswa($id_kelas)
    {
        $id_admin = session()->get('id');
        $data = [
            'title'     => 'Data Kelas Siswa',
            'sub'       => 'Halaman Kelas Siswa',
            'kelasSiswa' => $this->kelas->Data($id_kelas),
            'sekolah'   => $this->sekolah->getData(),
            'admin' => $this->admin->getData($id_admin)
        ];

        return view('admin/siswa/siswa-kelas', $data);
    }

    public function mapelKelas($id_kls)
    {
        $id_admin = session()->get('id');
        $data = [
            'title'     => 'Data Mata Pelajaran Siswa Perkelas',
            'sub'       => 'Halaman Kelas Siswa',
            'mapelKelas' => $this->kelas->dataMapel($id_kls),
            'sekolah'   => $this->sekolah->getData(),
            'admin' => $this->admin->getData($id_admin)
        ];

        return view('admin/mapel_kelas', $data);
    }
}