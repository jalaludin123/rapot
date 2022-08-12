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
              <form action="<?= base_url('admin/user/insert'); ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="Nama" class="form-label label ">Nama</label>
                  <input type="text" name="nama"
                    class="form-control form <?= $validation->hasError('nama') ? 'is-invalid' : null ?>" id="Nama"
                    value="<?= old('nama'); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Email" class="form-label label">Email</label>
                  <input type="email"
                    class="form-control form <?= $validation->hasError('email') ? 'is-invalid' : null; ?>" name="email"
                    id="Email" value="<?= old('email') ?>">
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
                  <label for="Level" class="form-label label">Level</label>
                  <select name="level" id="Level"
                    class="form-control form <?= $validation->hasError('level') ? 'is-invalid' : null; ?>">
                    <option value="">--Pilih Level--</option>
                    <option value="Admin" <?= old('level') == 'Admin' ? 'selected' : null ?>>Admin</option>
                  </select>
                  <div class="invalid-feedback">
                    <?= $validation->getError('level') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-3 box-img">
                      <img src="<?= base_url('assets/image/admin/default.png'); ?>" class="img-preview">
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