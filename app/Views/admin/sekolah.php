<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <?php foreach ($setting as $row) { ?>
        <div class="d-block bg-white rounded shadow p-3">
          <?php $validation = \Config\Services::validation(); ?>
          <form action="<?= base_url('admin/setting/update/' . $row['id_sekolah']); ?>" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="sekolah" value="<?= $row['id_sekolah']; ?>">
            <div class="ibox-title">
              <div class="row">
                <div class="col-md-8">
                  <h2><?= $title; ?></h2>
                </div>
              </div>
            </div>
            <div class="ibox-content mt-5">
              <div class="row">
                <?php
                  if (session()->getFlashData('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible fade show auto-close" role="alert">
                                            <strong>';
                    echo session()->getFlashdata('pesan');
                    echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                  }
                  ?>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="card card-outline card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Logo</h3>
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="text-center">
                        <img class="img-fluid pad" id="gambar_load"
                          src="<?= base_url('assets/image/admin/logo/' . $row['logo']); ?>" width="250px"
                          height="250px">
                      </div>
                      <div class="form-group">
                        <label>Ganti Logo</label>
                        <input name="logo" type="file" id="preview_gambar"
                          class="form-control <?= $validation->hasError('logo') ? 'is-invalid' : null; ?>"
                          accept="image/*">
                        <div class="invalid-feedback">
                          <?= $validation->getError('logo') ?>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="card card-outline card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Data Sekolah</h3>
                      <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="row sekolah">
                        <div class="mb-4 row">
                          <label for="Sekolah" class="col-sm-3 col-form-label">Nama Sekolah</label>
                          <div class="col-sm-7">
                            <input type="text"
                              class="form-control <?= $validation->hasError('nama_sekolah') ? 'is-invalid' : null; ?>"
                              id="Sekolah" name="nama_sekolah" value="<?= $row['nama_sekolah']; ?>">
                            <div class="invalid-feedback">
                              <?= $validation->getError('nama_sekolah') ?>
                            </div>
                          </div>
                        </div>
                        <div class="mb-4 row">
                          <label for="Kpsek" class="col-sm-3 col-form-label">Kepala Sekolah</label>
                          <div class="col-sm-7">
                            <input type="text"
                              class="form-control <?= $validation->hasError('kepala_sekolah') ? 'is-invalid' : null; ?>"
                              id="Kpsek" name="kepala_sekolah" value="<?= $row['kepala_sekolah']; ?>">
                            <div class="invalid-feedback">
                              <?= $validation->getError('kepala_sekolah') ?>
                            </div>
                          </div>
                        </div>
                        <div class="mb-4 row">
                          <label for="Nip" class="col-sm-3 col-form-label">Nip Kepala Sekolah</label>
                          <div class="col-sm-7">
                            <input type="text"
                              class="form-control <?= $validation->hasError('nip_kepsek') ? 'is-invalid' : null; ?>"
                              id="Nip" name="nip_kepsek" value="<?= $row['nip_kepsek']; ?>">
                            <div class="invalid-feedback">
                              <?= $validation->getError('nip_kepsek') ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <label for="Alamat" class="col-sm-3 col-form-label">Alamat Sekolah</label>
                          <div class="col-sm-7">
                            <textarea name="alamat_sekolah" id="Alamat"
                              class="form-control <?= $validation->hasError('alamat_sekolah') ? 'is-invalid' : null; ?>"
                              rows="4"><?= $row['alamat_sekolah']; ?></textarea>
                            <div class="invalid-feedback">
                              <?= $validation->getError('alamat_sekolah') ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="ibox-title"></div>
            <div class="row mt-4 button-row">
              <div class="col-md-12">
                <button class="btn btn-primary button" type="submit">Update</button>
              </div>
            </div>
          </form>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>