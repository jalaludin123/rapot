<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use App\Models\AdminModel;


class Dashboard extends BaseController
{

    public function __construct()
    {
        $this->sekolah = new SettingModel();
        $this->admin = new AdminModel();
    }

    public function index()
    {
        $id = session()->get('id');
        $data = [
            'title'     => 'Dashboard',
            'sub'       => 'Halaman Dashboard',
            'sekolah'   => $this->sekolah->getData(),
            'kelas'     => $this->admin->totalKelas(),
            'wali'      => $this->admin->totalWaliKelas(),
            'siswa'     => $this->admin->totalSiswa(),
            'mapel'     => $this->admin->totalMapel(),
            'admin'     => $this->admin->find($id)

        ];
        return view('dashboard', $data);
    }

    public function profile($id)
    {
        $data = [
            'title'     => 'Profile Admin',
            'sub'       => 'Halaman Profile',
            'sekolah'   => $this->sekolah->getData(),
            'admin'     => $this->admin->find($id)
        ];

        return view('admin/profile', $data);
    }

    public function updateProfile()
    {
        $id = $this->request->getVar('id');
        $dataLama = $this->admin->getData($id);
        if ($dataLama['email'] == $this->request->getPost('email')) {
            $rule_email = 'required';
        } else {
            $rule_email = 'required|is_unique[admin.email]';
        }
        $input = $this->validate([
            'nama'          => [
                'label'         => 'Nama',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'email'          => [
                'label'         => 'Email',
                'rules'         => $rule_email,
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'foto'          => [
                'label'         => 'Foto',
                'rules'         => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]|is_image[foto]',
                'errors'        => [
                    'max_size'  => 'Size {field} Terlalu Besar'
                ]
            ],
        ]);
        if (!$input) {
            return redirect()->to('dashboard/profile/' . $id)->withInput();
        } else if ($this->request->getPost('password') != '') {
            $file = $this->request->getFile('foto');
            if ($file->getError() == 4) {
                $data = [
                    'id'        => $id,
                    'nama'      => $this->request->getPost('nama'),
                    'email'     => $this->request->getPost('email'),
                    'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'foto' => $this->request->getVar('fotoLama'),
                    'level'     => $this->request->getPost('level')
                ];
            } else {
                $nama_file = $file->getRandomName();
                $user = $this->request->getVar('fotoLama');
                unlink('./assets/image/admin/' . $user);
                //upload file foto
                $file->move('assets/image/admin', $nama_file);
                $data = [
                    'id'        => $id,
                    'nama'      => $this->request->getPost('nama'),
                    'email'     => $this->request->getPost('email'),
                    'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'foto'        => $nama_file,
                    'level'     => $this->request->getPost('level')

                ];
            }
        } else {
            $file = $this->request->getFile('foto');
            if ($file->getError() == 4) {
                $data = [
                    'id'    => $id,
                    'nama'  => $this->request->getPost('nama'),
                    'email' => $this->request->getPost('email'),
                    // 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'foto' => $this->request->getVar('fotoLama'),
                    'level' => $this->request->getPost('level')
                ];
            } else {
                $nama_file = $file->getRandomName();
                $user = $this->request->getVar('fotoLama');
                unlink('./assets/image/admin/' . $user);
                //upload file foto
                $file->move('assets/image/admin', $nama_file);
                $data = [
                    'id'    => $id,
                    'nama'  => $this->request->getPost('nama'),
                    'email' => $this->request->getPost('email'),
                    // 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'foto'    => $nama_file,
                    'level' => $this->request->getPost('level')

                ];
            }
        }
        $this->admin->update($id, $data);
        session()->setFlashdata('edit', 'Data Berhasil Di Edit !!!');
        return redirect()->to(base_url('dashboard/profile/' . session()->get('id')));
    }
}