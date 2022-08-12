<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="card">
            <h5 class="card-header"><?= $title; ?></h5>
            <div class="card-body">
              <?php $validation = \Config\Services::validation(); ?>
              <form action="<?= base_url('admin/siswa/insert'); ?>" method="POST">
                <div class="mb-3">
                  <label for="Siswa" class="form-label label ">Nama Siswa</label>
                  <input type="text" name="nama_siswa"
                    class="form-control form <?= $validation->hasError('nama_siswa') ? 'is-invalid' : null; ?>"
                    id="Siswa" value="<?= old('nama_siswa'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama_siswa') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="NIS" class="form-label label">NIS</label>
                  <input type="text"
                    class="form-control form <?= $validation->hasError('nis') ? 'is-invalid' : null; ?>" name="nis"
                    id="NIS" value="<?= old('nis'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nis') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="NISN" class="form-label label">NISN</label>
                  <input type="text"
                    class="form-control form <?= $validation->hasError('nisn') ? 'is-invalid' : null; ?>" name="nisn"
                    id="NISN" value="<?= old('nisn'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nisn') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="lahir" class="form-label label">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir"
                    class="form-control form <?= $validation->hasError('tempat_lahir') ? 'is-invalid' : null; ?>"
                    id="lahir" value="<?= old('tempat_lahir'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('tempat_lahir') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="lahir" class="form-label label">Tanggal Lahir</label>
                  <input type="date" name="tgl_lahir"
                    class="form-control form <?= $validation->hasError('tgl_lahir') ? 'is-invalid' : null; ?>"
                    id="lahir" value="<?= old('tgl_lahir'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('tgl_lahir') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Agama" class="form-label label">Agama</label>
                  <input type="text" name="agama"
                    class="form-control form <?= $validation->hasError('agama') ? 'is-invalid' : null; ?>" id="Agama"
                    value="<?= old('agama'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('agama') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Ayah" class="form-label label">Nama Ayah</label>
                  <input type="text" name="nama_ayah"
                    class="form-control form <?= $validation->hasError('nama_ayah') ? 'is-invalid' : null; ?>" id="Ayah"
                    value="<?= old('nama_ayah'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama_ayah') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Ibu" class="form-label label">Nama Ibu</label>
                  <input type="text" name="nama_ibu"
                    class="form-control form <?= $validation->hasError('nama_ibu') ? 'is-invalid' : null; ?>" id="Ibu"
                    value="<?= old('nama_ibu'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama_ibu') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Telepon" class="form-label label">No Telepon</label>
                  <input type="text" name="no_telepon"
                    class="form-control form <?= $validation->hasError('no_telepon') ? 'is-invalid' : null; ?>"
                    id="Telepon" value="<?= old('no_telepon'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('no_telepon') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label label">Jenis Kelamin</label>
                  <select name="jenis_kelamin"
                    class="form-control form <?= $validation->hasError('jenis_kelamin') ? 'is-invalid' : null ?>">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Pria" <?= old('jenis_kelamin') == "Pria" ? 'selected' : null; ?>>Pria</option>
                    <option value="Wanita" <?= old('jenis_kelamin') == "Wanita" ? 'selected' : null; ?>>Wanita</option>
                  </select>
                  <div class="invalid-feedback">
                    <?= $validation->getError('jenis_kelamin') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="kelas" class="form-label label">Kelas</label>
                  <select class="form-control form <?= $validation->hasError('id_kls') ? 'is-invalid' : null ?>"
                    aria-label="Default select example" name="id_kls" id="kelas">
                    <option value="">--Pilih Kelas--</option>
                    <?php foreach ($kls as $k) { ?>
                    <option value="<?= $k['id_kls']; ?>" <?= old('id_kls') == $k['id_kls'] ? 'selected' : null; ?>>
                      <?= $k['kls']; ?></option>
                    <?php } ?>
                  </select>
                  <div class="invalid-feedback">
                    <?= $validation->getError('id_kls') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Kelas" class="form-label label">Nama Kelas</label>
                  <select class="form-control form <?= $validation->hasError('id_kelas') ? 'is-invalid' : null ?>"
                    aria-label="Default select example" name="id_kelas" id="Kelas">
                    <option value="">--Pilih Nama Kelas--</option>
                    <?php foreach ($kelas as $row) { ?>
                    <option value="<?= $row['id_kelas']; ?>"
                      <?= old('id_kelas') == $row['id_kelas'] ? 'selected' : null; ?>><?= $row['nama_kelas']; ?>
                    </option>
                    <?php } ?>
                  </select>
                  <div class="invalid-feedback">
                    <?= $validation->getError('id_kelas') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Alamat" class="form-label label">Alamat</label>
                  <textarea name="alamat" id="Alamat"
                    class="form-control form <?= $validation->hasError('alamat') ? 'is-invalid' : null; ?>"><?= old('alamat'); ?></textarea>
                  <div class="invalid-feedback">
                    <?= $validation->getError('alamat') ?>
                  </div>
                </div>
                <div class="mt-5 save">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>