<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\MapelModel;
use App\Models\SettingModel;
use App\Models\KlsModel;

class Mapel extends BaseController
{

    public function __construct()
    {
        $this->mapel = new MapelModel();
        $this->sekolah = new SettingModel();
        $this->kls = new KlsModel();
        $this->admin = new AdminModel();
    }

    public function index()
    {
        $id_admin = session()->get('id');
        $data = [
            'title' => 'Mata pelajaran',
            'sub'   => 'Halaman Mata pelajaran',
            'mapel' => $this->mapel->get(),
            'kls'   => $this->kls->findAll(),
            'sekolah'   => $this->sekolah->getData(),
            'admin' => $this->admin->getData($id_admin)
        ];

        return view('admin/mapel', $data);
    }

    public function insert()
    {
        $input = $this->validate([
            'kode_mapel'          => [
                'label'         => 'Kode Mapel',
                'rules'         => 'required|is_unique[mapel.kode_mapel]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'nama_mapel'          => [
                'label'         => 'Nama Mapel',
                'rules'         => 'required|is_unique[mapel.nama_mapel]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ]
        ]);
        if (!$input) {
            return redirect()->to('admin/mapel')->withInput();
        } else {
            $data = $this->request->getPost();
            $this->mapel->insert($data);

            session()->setFlashdata("success", "Data Berhasil Di Tambahkan");
            return redirect()->to(base_url('admin/mapel'));
        }
    }

    public function edit($id_mapel)
    {
        $dataLama = $this->mapel->find($this->request->getVar('id'));
        if ($dataLama['nama_mapel'] == $this->request->getPost('nama_mapel')) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[mapel.nama_mapel]';
        }
        $input = $this->validate([
            'nama_mapel' => [
                'rules' => $rule,
                'errors' => [
                    'required' => 'Nama Mapel Tidak Boleh Kosong',
                    'is_unique' => 'Nama Mapel Sudah Di Gunakan'
                ]
            ]
        ]);
        if (!$input) {
            return redirect()->to('admin/mapel')->withInput();
        } else {
            $data = $this->request->getPost();

            $this->mapel->update($id_mapel, $data);
            session()->setFlashdata("edit", "Data Berhasil Di Edit");
            return redirect()->to(base_url('admin/mapel'));
        }
    }

    public function delate($id_mapel)
    {
        $this->mapel->find($id_mapel);

        $data = [
            'id_mapel' => $id_mapel
        ];

        $this->mapel->delete($data);

        session()->setFlashdata("hapus", "Data Berhasil Di Hapus");
        return redirect()->to(base_url('admin/mapel'));
    }
}