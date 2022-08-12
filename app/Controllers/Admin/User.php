<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SettingModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->sekolah = new SettingModel();
    }

    public function index()
    {
        $id_admin = session()->get('id');
        $data = [
            'title' => 'Admin',
            'sub'   => 'Halaman Admin',
            'admins' => $this->admin->findAll(),
            'sekolah' => $this->sekolah->getData(),
            'admin'     => $this->admin->getData($id_admin)
        ];

        return view('admin/admin', $data);
    }

    public function addUser()
    {
        $id_admin = session()->get('id');
        $data = [
            'title' => 'Tambah Data User',
            'sub'   => 'Halaman Admin',
            'sekolah' => $this->sekolah->getData(),
            'admin'     => $this->admin->getData($id_admin)
        ];

        return view('admin/addAdmin', $data);
    }

    public function insert()
    {

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
                'rules'         => 'required|is_unique[admin.email]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'password'          => [
                'label'         => 'Password',
                'rules'         => 'required|min_length[6]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'min_length' => '{field} Minimal 6 Karakter',
                ]
            ],
            'foto'          => [
                'label'         => 'Foto',
                'rules'         => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]|is_image[foto]',
                'errors'        => [
                    'max_size'  => 'Size {field} Terlalu Besar'
                ]
            ],
            'level'          => [
                'label'         => 'Level',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
        ]);
        if (!$input) {
            return redirect()->back()->withInput();
        } else {
            $img        = $this->request->getFile('foto');
            if ($img->getError() == 4) {
                $namaAcak = 'default.png';
            } else {
                $namaAcak   = $img->getRandomName(); //nama file gambar dibuat acak supaya tidak sama
                $img->move('assets/image/admin', $namaAcak); //direktori file upload
            }

            $data = [
                'nama'      => $this->request->getPost('nama'),
                'email'     => $this->request->getPost('email'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'foto'      => $namaAcak,
                'level'     => $this->request->getPost('level')
            ];

            $this->admin->insert($data);

            session()->setFlashdata("success", "Data Berhasil Di Tambahkan");
            return redirect()->to(base_url('admin/user'));
        }
    }


    public function update($id)
    {
        $dataUser = $this->admin->getData($id);
        if (empty($dataUser)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak Di Temukan');
        }
        $data = [
            'title'     => 'Edit Data User',
            'sub'       => 'Halaman Siswa',
            'sekolah'   => $this->sekolah->getData(),
            'admin'     => $dataUser,
        ];
        return view('admin/edituser', $data);
    }

    public function edit($id)
    {
        $dataLama = $this->admin->getData($this->request->getVar('id'));
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
            return redirect()->to('admin/user/update/' . $id)->withInput();
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
        return redirect()->to(base_url('admin/user'));
    }

    public function delate($id)
    {
        $user = $this->admin->getData($id);
        if ($user['foto'] != "default.png") {
            unlink('./assets/image/admin/' . $user['foto']);
        }
        $data = [
            'id' => $id
        ];
        $this->admin->delete($data);
        session()->setFlashdata('hapus', 'Data Berhasil Di Hapus');
        return redirect()->to(base_url('admin/user'));
    }
}