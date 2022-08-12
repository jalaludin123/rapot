<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use App\Models\DataguruModel;

class Dashboard extends BaseController
{

    public function __construct()
    {
        $this->sekolah = new SettingModel();
        $this->wali = new DataguruModel();
    }

    // public function index()
    // {
    //    $data = [
    //        'title' => 'Dahsboard',
    //        'sub'   => 'Halaman Wali Kelas',
    //        'sekolah'   => $this->sekolah->getData(),
    //        'kelas'    => $this->wali->getData()
    //    ];
    //    return view('guru/nilai', $data);
    // }

    public function profile($id)
    {
        $data = [
            'title'         => 'Profile Wali Kelas',
            'sub'           => 'Halaman Profile',
            'sekolah'       => $this->sekolah->getData(),
            'users'          => $this->wali->getWali($id)
        ];

        return view('guru/profile', $data);
    }

    public function updateProfile()
    {
        $id = $this->request->getVar('id');
        $dataLama = $this->wali->getWali($id);
        if ($dataLama['email'] == $this->request->getPost('email')) {
            $rule_email = 'required';
        } else {
            $rule_email = 'required|is_unique[wali_kelas.email]';
        }

        if ($dataLama['nip'] == $this->request->getPost('nip')) {
            $rule_nip = 'required';
        } else {
            $rule_nip = 'required|is_unique[wali_kelas.nip]';
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
            'nip'          => [
                'label'         => 'Nip',
                'rules'         => $rule_nip,
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'phone'          => [
                'label'         => 'No Telepon',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'jk'          => [
                'label'         => 'Jenis Kelamin',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ]
        ]);
        if (!$input) {
            return redirect()->to('guru/dashboard/profile/' . $id)->withInput();
        } else if ($this->request->getPost('password') != '') {
            $file = $this->request->getFile('foto');
            if ($file->getError() == 4) {
                $data = [
                    'id'        => $id,
                    'id_kelas'  => $this->request->getPost('id_kelas'),
                    'nama'      => $this->request->getPost('nama'),
                    'email'     => $this->request->getPost('email'),
                    'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'nip'       => $this->request->getPost('nip'),
                    'phone'     => $this->request->getPost('phone'),
                    'jk'        => $this->request->getPost('jk'),
                    'foto'      => $this->request->getVar('fotoLama'),
                    'level'     => $this->request->getPost('level')
                ];
            } else {
                $nama_file = $file->getRandomName();
                $user = $this->request->getVar('fotoLama');
                unlink('./assets/image/walikelas/' . $user);
                //upload file foto
                $file->move('assets/image/walikelas', $nama_file);
                $data       = [
                    'id'        => $id,
                    'id_kelas'  => $this->request->getPost('id_kelas'),
                    'nama'      => $this->request->getPost('nama'),
                    'email'     => $this->request->getPost('email'),
                    'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'nip'       => $this->request->getPost('nip'),
                    'phone'     => $this->request->getPost('phone'),
                    'foto'        => $nama_file,
                    'jk'        => $this->request->getPost('jk'),
                    'level'     => $this->request->getPost('level')

                ];
            }
        } else {
            $file = $this->request->getFile('foto');
            if ($file->getError() == 4) {
                $data = [
                    'id'    => $id,
                    'id_kelas'  => $this->request->getPost('id_kelas'),
                    'nama'  => $this->request->getPost('nama'),
                    'email' => $this->request->getPost('email'),
                    // 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'nip'   => $this->request->getPost('nip'),
                    'phone' => $this->request->getPost('phone'),
                    'jk'    => $this->request->getPost('jk'),
                    'foto'      => $this->request->getVar('fotoLama'),
                    'level' => $this->request->getPost('level')
                ];
            } else {
                $nama_file = $file->getRandomName();
                $user = $this->request->getVar('fotoLama');
                unlink('./assets/image/walikelas/' . $user);
                //upload file foto
                $file->move('assets/image/walikelas', $nama_file);
                $data       = [
                    'id'    => $id,
                    'id_kelas'  => $this->request->getPost('id_kelas'),
                    'nama'  => $this->request->getPost('nama'),
                    'email' => $this->request->getPost('email'),
                    // 'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'nip'   => $this->request->getPost('nip'),
                    'phone' => $this->request->getPost('phone'),
                    'foto'    => $nama_file,
                    'jk'    => $this->request->getPost('jk'),
                    'level' => $this->request->getPost('level')

                ];
            }
        }
        $this->wali->update($id, $data);
        session()->setFlashdata('edit', 'Data Berhasil Di Edit !!!');
        return redirect()->to('guru/dashboard/profile/' . session()->get('id'));
    }
}