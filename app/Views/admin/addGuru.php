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
              <form action="<?= base_url('admin/dataguru/insert'); ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="Nama" class="form-label label ">Nama</label>
                  <input type="text" name="nama"
                    class="form-control form <?= $validation->hasError('nama') ? 'is-invalid' : null; ?>" id="Nama"
                    value="<?= old('nama'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Email" class="form-label label">Email</label>
                  <input type="email"
                    class="form-control form <?= $validation->hasError('email') ? 'is-invalid' : null; ?>" name="email"
                    id="Email" value="<?= old('email'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Password" class="form-label label">Password</label>
                  <input type="password"
                    class="form-control form <?= $validation->hasError('password') ? 'is-invalid' : null; ?>"
                    name="password" id="Password" value="<?= old('password'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('password') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Nip" class="form-label label">Nip</label>
                  <input type="text"
                    class="form-control form <?= $validation->hasError('nip') ? 'is-invalid' : null; ?>" name="nip"
                    id="Nip" value="<?= old('nip'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nip') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Phone" class="form-label label">No Telepon</label>
                  <input type="text"
                    class="form-control form <?= $validation->hasError('phone') ? 'is-invalid' : null; ?>" name="phone"
                    id="Phone" value="<?= old('phone'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('phone') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Kelas" class="form-label label">Kelas</label>
                  <select name="id_kelas" id="Kelas"
                    class="form-control form <?= $validation->hasError('id_kelas') ? 'is-invalid' : null; ?>">
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelas as $kls) { ?>
                    <option value="<?= $kls['id_kelas']; ?>"
                      <?= old('id_kelas') == $kls['id_kelas'] ? 'selected' : null ?>><?= $kls['nama_kelas']; ?></option>
                    <?php } ?>
                  </select>
                  <div class="invalid-feedback">
                    <?= $validation->getError('id_kelas') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="mb-3">
                    <label for="Jk" class="form-label label">Jenis Kelamin</label>
                    <select name="jk" id="Jk"
                      class="form-control form <?= $validation->hasError('jk') ? 'is-invalid' : null; ?>">
                      <option value="">--Pilih Jenis Kelamin--</option>
                      <option value="Pria" <?= old('jk') == 'Pria' ? 'selected' : null; ?>>Pria</option>
                      <option value="Wanita" <?= old('jk') == 'Wanita' ? 'selected' : null; ?>>Wanita</option>
                    </select>
                    <div class="invalid-feedback">
                      <?= $validation->getError('jk') ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="Level" class="form-label label">Level</label>
                    <select name="level" id="Level"
                      class="form-control form <?= $validation->hasError('level') ? 'is-invalid' : null; ?>">
                      <option value="">--Pilih Level--</option>
                      <option value="Wali Kelas" <?= old('level') == 'Wali Kelas' ? 'selected' : null; ?>>Wali Kelas
                      </option>
                    </select>
                    <div class="invalid-feedback">
                      <?= $validation->getError('level') ?>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-3 box-img">
                        <img src="<?= base_url('assets/image/walikelas/default.png'); ?>" class="img-preview">
                      </div>
                      <div class="col-9">
                        <label class="form-label label">Foto</label>
                        <input type="file" name="foto"
                          class="form-control form <?= $validation->hasError('foto') ? 'is-invalid' : null; ?>"
                          id="Preview" onchange="PreviewImg()">
                        <div class="invalid-feedback">
                          <?= $validation->getError('foto') ?>
                        </div>
                      </div>
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