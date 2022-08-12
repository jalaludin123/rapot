<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SettingModel;

class Setting extends BaseController
{

	public function __construct()
	{
		$this->sekolah = new SettingModel();
		$this->admin = new AdminModel();
	}

	public function index()
	{
		$id_admin = session()->get('id');
		$data = [
			'title'     => 'Data Sekolah',
			'sub'       => 'Halaman Data Sekolah',
			'setting'   => $this->sekolah->findAll(),
			'sekolah'   => $this->sekolah->getData(),
			'admin' => $this->admin->getData($id_admin)
		];

		return view('admin/sekolah', $data);
	}

	public function update($id_sekolah)
	{
		$file = $this->request->getFile('logo');
		$input = $this->validate([
			'logo'          => [
				'label'         => 'Logo',
				'rules'         => 'max_size[logo,2048]|is_image[logo]|ext_in[logo,png,jpg,gif]',
				'errors'        => [
					'max_size'  => '{field} Maksimal 2 mb',
					'is_image'  => '{field} Harus Gambar atau Foto',
					'ext_in'  => '{field} Extension Harus JPG, PNG dan GIF',
				]
			],
			'nama_sekolah'          => [
				'label'         => 'Nama Sekolah',
				'rules'         => 'required',
				'errors'        => [
					'required'  => '{field} Tidak Boleh Kosong'
				]
			],
			'kepala_sekolah'          => [
				'label'         => 'Nama Kepala Sekolah',
				'rules'         => 'required',
				'errors'        => [
					'required'  => '{field} Tidak Boleh Kosong'
				]
			],
			'nip_kepsek'          => [
				'label'         => 'Nip Kepala Sekolah',
				'rules'         => 'required',
				'errors'        => [
					'required'  => '{field} Tidak Boleh Kosong'
				]
			],
			'alamat_sekolah'          => [
				'label'         => 'Alamat Sekolah',
				'rules'         => 'required',
				'errors'        => [
					'required'  => '{field} Tidak Boleh Kosong'
				]
			],
		]);
		if (!$input) {
			return redirect()->back()->withInput();
		} else	if ($file->getError() == 4) {
			$data = [
				'id_sekolah'    => $id_sekolah,
				'nama_sekolah' => $this->request->getPost('nama_sekolah'),
				'kepala_sekolah' => $this->request->getPost('kepala_sekolah'),
				'nip_kepsek'	=> $this->request->getPost('nip_kepsek'),
				'alamat_sekolah' => $this->request->getPost('alamat_sekolah')
			];
			$this->sekolah->update($id_sekolah, $data);
		} else {

			$setting = $this->sekolah->find($id_sekolah);
			if ($setting['logo'] != "") {
				unlink('./assets/image/admin/logo/' . $setting['logo']);
			}

			$nama_file = $file->getRandomName();
			$data = [
				'id_sekolah'    => $id_sekolah,
				'nama_sekolah' => $this->request->getPost('nama_sekolah'),
				'kepala_sekolah' => $this->request->getPost('kepala_sekolah'),
				'nip_kepsek'	=> $this->request->getPost('nip_kepsek'),
				'alamat_sekolah' => $this->request->getPost('alamat_sekolah'),
				'logo'	=> $nama_file
			];
			//upload file foto
			$file->move('assets/image/admin/logo/', $nama_file);
			$this->sekolah->update($id_sekolah, $data);
		}
		session()->setFlashdata('pesan', 'Setting Berhasil Diganti...!!!');
		return redirect()->to('/admin/setting');
	}
}