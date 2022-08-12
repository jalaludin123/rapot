<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\DataguruModel;
use App\Models\SettingModel;

class Login extends BaseController
{

    public function __construct()
    {
        $this->admin        = new AdminModel();
        $this->walikelas    = new DataguruModel();
        $this->sekolah      = new SettingModel();
    }

    // Source Code Halaman Awal Login
    public function index()
    {
        $data = [
            'title' => 'Login',
            'sub'   => 'Halaman Login',
            'sekolah' => $this->sekolah->getData()
        ];
        return view('login', $data);
    }

    // Source Code Proses Login
    public function cek_login()
    {
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'email' => [
                'label'         => 'Email',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'password'          => [
                'label'         => 'Password',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $sessError = [
                'errEmail'  => $validation->getError('email'),
                'errPass'   => $validation->getError('password')
            ];
            session()->setFlashdata($sessError);
            return redirect()->to(base_url('login'));
        }

        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('password');

        $admin      = $this->admin->where(['email'      => $email,])->first();
        $walikelas  = $this->walikelas->where(['email'  => $email,])->first();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $data = [
                    'isLogin'   =>  true,
                    'id'        => $admin['id'],
                    'nama'      => $admin['nama'],
                    'email'     => $admin['email'],
                    'foto'      => $admin['foto'],
                    'level'     => $admin['level']
                ];
                session()->set($data);
                return redirect()->to(base_url('dashboard'));
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->to(base_url('login'));
            }
        }
        if ($walikelas) {
            if (password_verify($password, $walikelas['password'])) {
                $data = [
                    'isLogin'   => true,
                    'id'        => $walikelas['id'],
                    'id_kelas'        => $walikelas['id_kelas'],
                    'nama'      => $walikelas['nama'],
                    'email'     => $walikelas['email'],
                    'nip'       => $walikelas['nip'],
                    'phone'     => $walikelas['phone'],
                    'foto'      => $walikelas['foto'],
                    'jk'        => $walikelas['jk'],
                    'level'     => $walikelas['level']
                ];
                session()->set($data);
                return redirect()->to(base_url('guru/nilai'));
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->to(base_url('login'));
            }
        } else {
            session()->setFlashdata('gagal', 'Akun Tidak Terdaftar');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        session()->destroy();

        session()->setFlashdata('logout', 'Anda Berhasil Logout');
        return redirect()->to(base_url('login'));
    }
}