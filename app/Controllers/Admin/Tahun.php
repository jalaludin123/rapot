<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\TahunModel;
use App\Models\SettingModel;


class Tahun extends BaseController
{

    public function __construct()
    {
        $this->tahun = new TahunModel();
        $this->sekolah = new SettingModel();
        $this->admin = new AdminModel();
    }


    public function index()
    {
        $id_admin = session()->get('id');
        $data = [
            'title'     => 'Tahun Ajaran',
            'sub'       => 'Halaman Tahun Ajaran',
            'tahun'     => $this->tahun->findAll(),
            'sekolah'   => $this->sekolah->getData(),
            'admin' => $this->admin->getData($id_admin)
        ];

        return view('admin/tahun', $data);
    }

    public function insert()
    {
        $data = [
            'thn'           => $this->request->getPost('thn'),
            'thn_ajaran'    => $this->request->getPost('thn_ajaran')
        ];

        $this->tahun->insert($data);

        session()->setFlashdata('success', 'Data Berhasil Di Tambahkan');
        return redirect()->to(base_url('admin/tahun'));
    }

    public function edit($id_thn)
    {
        $data = [
            'id'            => $id_thn,
            'thn'           => $this->request->getPost('thn'),
            'thn_ajaran'    => $this->request->getPost('thn_ajaran')
        ];

        $this->tahun->update($id_thn, $data);
        session()->setFlashdata('edit', 'Data Berhasil Di Update');
        return redirect()->to(base_url('admin/tahun'));
    }

    public function delate($id_thn)
    {
        $this->tahun->find($id_thn);
        $data = [
            'id_thn'    => $id_thn
        ];

        $this->tahun->delete($data);
        session()->setFlashdata('hapus', 'Data Berhasil Di Hapus');
        return redirect()->to(base_url('admin/tahun'));
    }

    public function statusAktif($id_thn)
    {
        $data = [
            'id_thn' => $id_thn,
            'status' => 1
        ];
        $this->tahun->resetStatus();
        $this->tahun->update($id_thn, $data);
        session()->setFlashdata('success', 'Status Tahun Ajaran Berhasil Diganti');
        return redirect()->to(base_url('admin/tahun'));
    }

    public function statusNonaktif($id_thn)
    {
        $data = [
            'id_thn' => $id_thn,
            'status' => 0
        ];
        $this->tahun->update($id_thn, $data);
        session()->setFlashdata('success', 'Status Tahun Ajaran Berhasil Diganti');
        return redirect()->to(base_url('admin/tahun'));
    }
}