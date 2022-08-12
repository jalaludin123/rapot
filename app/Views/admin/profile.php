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
              <?php $validation = \Config\Services::validation();
              if (session()->getFlashData('edit')) {
                echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                                <strong>';
                echo session()->getFlashdata('edit');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              } ?>
              <form action="<?= base_url('dashboard/updateProfile'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $admin['id']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $admin['foto']; ?>">
                <div class="mb-3">
                  <label for="Nama" class="form-label label ">Nama</label>
                  <input type="text" name="nama"
                    class="form-control form <?= $validation->hasError('nama') ? 'is-invalid' : null; ?>" id="Nama"
                    value="<?= old('nama', $admin['nama']); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Email" class="form-label label">Email</label>
                  <input type="email"
                    class="form-control form <?= $validation->hasError('email') ? 'is-invalid' : null; ?>" name="email"
                    id="Email" value="<?= old('email', $admin['email']); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Password" class="form-label label">Password</label>
                  <input type="password" class="form-control form" name="password" id="Password">
                </div>
                <div class="mb-3">
                  <label for="Level" class="form-label label">Level</label>
                  <select name="level" id="Level" class="form-select form">
                    <option value="<?= $admin['level']; ?>"><?= $admin['level']; ?></option>
                  </select>
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-3 box-img">
                      <img src="<?= base_url('assets/image/admin/' . $admin['foto']); ?>" class="img-preview">
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