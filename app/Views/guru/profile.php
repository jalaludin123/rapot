<?= $this->extend("template/layout-walikelas") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="card">
            <h5 class="card-header"><?= $title; ?></h5>
            <div class="card-body">
              <?php
                            $validation = \Config\Services::validation();
                            if (session()->getFlashData('edit')) {
                                echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                                <strong>';
                                echo session()->getFlashdata('edit');
                                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                            }
                            ?>
              <form action="<?= base_url('guru/dashboard/updateProfile'); ?>" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $users['id']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $users['foto']; ?>">
                <div class="mb-3">
                  <label for="Nama" class="form-label label ">Nama</label>
                  <input type="text" name="nama"
                    class="form-control form <?= $validation->hasError('nama') ? 'is-invalid' : null; ?>" id="Nama"
                    value="<?= old('nama', $users['nama']); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Email" class="form-label label">Email</label>
                  <input type="email"
                    class="form-control form <?= $validation->hasError('email') ? 'is-invalid' : null; ?>" name="email"
                    id="Email" value="<?= old('email', $users['email']); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Password" class="form-label label">Password</label>
                  <input type="password" class="form-control form" name="password" id="Password">
                </div>
                <div class="mb-3">
                  <label for="Nip" class="form-label label">Nip</label>
                  <input type="text"
                    class="form-control form <?= $validation->hasError('nip') ? 'is-invalid' : null; ?>" name="nip"
                    id="Nip" value="<?= old('nip', $users['nip']); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nip') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Phone" class="form-label label">No Telepon</label>
                  <input type="text"
                    class="form-control form <?= $validation->hasError('phone') ? 'is-invalid' : null; ?>" name="phone"
                    id="Phone" value="<?= old('phone', $users['phone']); ?>">
                  <div class="invalid-feedback">
                    <?= $validation->getError('phone') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Kelas" class="form-label label">Kelas</label>
                  <input type="text" class="form-control form" value="<?= $users['nama_kelas']; ?>" name="id_kelas"
                    readonly>
                </div>
                <div class="mb-3">
                  <label for="Jk" class="form-label label">Jenis Kelamin</label>
                  <select name="jk" id="Jk"
                    class="form-control form <?= $validation->hasError('jk') ? 'is-invalid' : null; ?>">
                    <option value="" hidden></option>
                    <option value="Pria" <?= old('jk', $users['jk']) == 'Pria' ? 'selected' : null; ?>>Pria</option>
                    <option value="Wanita" <?= old('jk', $users['jk']) == 'Wanita' ? 'selected' : null; ?>>Wanita
                    </option>
                  </select>
                  <div class="invalid-feedback">
                    <?= $validation->getError('jk') ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="Level" class="form-label label">Level</label>
                  <input type="text" class="form-control form" name="level" value="<?= $users['level']; ?>" readonly>
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-3 box-img">
                      <img src="<?= base_url('assets/image/walikelas/' . $users['foto']); ?>" class="img-preview">
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