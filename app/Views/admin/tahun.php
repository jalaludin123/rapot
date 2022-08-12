<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-8">
                  <h4>Data <?= $title; ?></h4>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-primary adm_btn" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" style="float: right; ">Tambah Data <i
                      class="fa fa-plus-circle"></i></button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?php
              if (session()->getFlashData('success')) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>';
                echo session()->getFlashdata('success');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }

              if (session()->getFlashData('hapus')) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>';
                echo session()->getFlashdata('hapus');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }

              if (session()->getFlashData('edit')) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>';
                echo session()->getFlashdata('edit');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }
              ?>

              <div class="table-responsive">
                <table id="example" class="display">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tahun</th>
                      <th>Tahun Ajaran</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($tahun as $row) {
                    ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $row['thn']; ?></td>
                      <td><?= $row['thn_ajaran']; ?></td>
                      <td>
                        <?php if ($row['status'] == 1) { ?>
                        <a href="<?= base_url('admin/tahun/statusNonaktif/' . $row['id_thn']) ?>"
                          class="btn btn-danger btn-xs btn-flat">Nonaktifkan</a>
                        <?php } else { ?>
                        <a href="<?= base_url('admin/tahun/statusAktif/' . $row['id_thn']) ?>"
                          class="btn btn-success btn-xs btn-flat">Aktifkan</a>
                        <?php } ?>
                      </td>
                      <td class="adm_td">
                        <a href="" class="btn btn-warning adm_tda" data-bs-toggle="modal"
                          data-bs-target="#edit<?= $row['id_thn']; ?>"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/tahun/delate/' . $row['id_thn']); ?>" class="btn btn-danger"><i
                            class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/tahun/insert'); ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data <?= $title; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 row">
            <label for="Tahun" class="col-sm-4 col-form-label">Tahun</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="Tahun" name="thn" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="Thn" class="col-sm-4 col-form-label">Tahun Ajaran</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="thn_ajaran" id="Thn" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal edit -->
<?php foreach ($tahun as $row) { ?>
<div class="modal fade" id="edit<?= $row['id_thn']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/tahun/edit/' . $row['id_thn']); ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data <?= $title; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 row">
            <label for="Tahun" class="col-sm-4 col-form-label">Tahun</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="Tahun" name="thn" value="<?= $row['thn']; ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="Thn" class="col-sm-4 col-form-label">Tahun Ajaran</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="thn_ajaran" value="<?= $row['thn_ajaran']; ?>" id="Thn">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php } ?>
<?= $this->endSection() ?>