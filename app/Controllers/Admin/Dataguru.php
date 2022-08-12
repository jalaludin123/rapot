<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\DataguruModel;
use App\Models\SettingModel;
use App\Models\KelasModel;

class Dataguru extends BaseController
{

    public function __construct()
    {
        $this->walikelas = new DataguruModel();
        $this->sekolah = new SettingModel();
        $this->kelas = new KelasModel();
        $this->admin = new AdminModel();
    }

    //Source Code Halaman Awal Wali Kelas
    public function index()
    {
        $id = session()->get('id');
        $data = [
            'title'     => 'Wali Kelas',
            'sub'       => 'Halaman Wali Kelas',
            'user'      => $this->walikelas->getData(),
            'sekolah'   => $this->sekolah->getData(),
            'kelas'     => $this->kelas->findAll(),
            'admin'     => $this->admin->find($id)
        ];
        return view('admin/dataguru', $data);
    }

    public function addGuru()
    {
        $id = session()->get('id');
        $data = [
            'title' => 'Tambah Data Wali Kelas',
            'sub'   => 'Halaman Wali Kelas',
            'kelas'     => $this->kelas->findAll(),
            'sekolah' => $this->sekolah->getData(),
            'admin'     => $this->admin->find($id)
        ];

        return view('admin/addGuru', $data);
    }
    // Source Code Tambah Data Wali Kelas
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
                'rules'         => 'required|is_unique[wali_kelas.email]',
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
            'nip'          => [
                'label'         => 'Nip',
                'rules'         => 'required|is_unique[wali_kelas.nip]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan',
                ]
            ],
            'phone'          => [
                'label'         => 'No Telepon',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'id_kelas'          => [
                'label'         => 'Nama Kelas',
                'rules'         => 'required|is_unique[wali_kelas.id_kelas]',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
                ]
            ],
            'jk'          => [
                'label'         => 'Jenis Kelamin',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
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
                $img->move('assets/image/walikelas', $namaAcak); //direktori file upload
            }

            $data = [
                'id'        => $this->request->getPost('id'),
                'id_kelas'  => $this->request->getPost('id_kelas'),
                'nama'      => $this->request->getPost('nama'),
                'email'     => $this->request->getPost('email'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'nip'       => $this->request->getPost('nip'),
                'phone'     => $this->request->getPost('phone'),
                'foto'      => $namaAcak,
                'jk'        => $this->request->getPost('jk'),
                'level'     => $this->request->getPost('level')

            ];

            $this->walikelas->insert($data);
            $session = session();
            $session->setFlashdata("success", "Data Berhasil Di Tambahkan");
            return redirect()->to(base_url('admin/dataguru'));
        }
    }

    public function update($id)
    {
        $id_admin = session()->get('id');
        $dataUser = $this->walikelas->getWali($id);
        if (empty($dataUser)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak Di Temukan');
        }
        $data = [
            'title'     => 'Edit Data Wali Kelas',
            'sub'       => 'Halaman Siswa',
            'sekolah'   => $this->sekolah->getData(),
            'kelas'     => $this->kelas->findAll(),
            'users'     => $dataUser,
            'admin'     => $this->admin->find($id_admin)
        ];
        return view('admin/editguru', $data);
    }
    // Source Code Halaman Edit Wali Kelas
    public function edit($id)
    {
        $dataLama = $this->walikelas->getWali($this->request->getVar('id'));
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

        if ($dataLama['id_kelas'] == $this->request->getPost('id_kelas')) {
            $rule_kelas = 'required';
        } else {
            $rule_kelas = 'required|is_unique[wali_kelas.id_kelas]';
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
            'id_kelas'          => [
                'label'         => 'Nama Kelas',
                'rules'         => $rule_kelas,
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Di Gunakan'
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
            return redirect()->to('admin/dataguru/update/' . $id)->withInput();
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
        $this->walikelas->update($id, $data);
        session()->setFlashdata('edit', 'Data Berhasil Di Edit !!!');
        return redirect()->to('/admin/dataguru');
    }

    // Source Code Hapus Data Wali Kelas
    public function delate($id)
    {
        $user = $this->walikelas->find($id);
        if ($user['foto'] != "default.png") {
            unlink('./assets/image/walikelas/' . $user['foto']);
        }
        $data = [
            'id' => $id
        ];
        $this->walikelas->delete($data);
        session()->setFlashdata('hapus', 'Data Berhasil Di Hapus');
        return redirect()->to(base_url('admin/dataguru'));
    }

    public function kelas($id_kelas)
    {
        $id_admin = session()->get('id');
        $data = [
            'title'     => 'Data Kelas Siswa',
            'sub'       => 'Halaman Kelas Siswa',
            'sekolah'   => $this->sekolah->getData(),
            'kelasSiswa' => $this->walikelas->kelasSiswa($id_kelas),
            'admin'     => $this->admin->getData($id_admin)
        ];

        return view('admin/siswa/siswa-kelas', $data);
    }
}