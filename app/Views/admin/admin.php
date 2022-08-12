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
                  <a href="<?= base_url('admin/user/addUser'); ?>" class="btn btn-primary" style="float: right; ">Tambah
                    Data <i class="fa fa-plus-circle"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?php

              if (session()->getFlashData('success')) {
                echo '<div class="alert alert-success alert-dismissible fade show auto-close" role="alert">
                                <strong>';
                echo session()->getFlashdata('success');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }

              if (session()->getFlashData('hapus')) {
                echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                                <strong>';
                echo session()->getFlashdata('hapus');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }

              if (session()->getFlashData('edit')) {
                echo '<div class="alert alert-success alert-dismissible fade show auto-close" role="alert">
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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Foto</th>
                      <th>Level</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($admins as $row) {
                    ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $row['nama']; ?></td>
                      <td><?= $row['email']; ?></td>
                      <td><img src="<?= base_url('assets/image/admin/' . $row['foto']); ?>" alt=""
                          style="width: 50px;height:50px;"></td>
                      <td><?= $row['level']; ?></td>
                      <td class="adm_td">
                        <a href="<?= base_url('admin/user/update/' . $row['id']); ?>" class="btn btn-warning adm_tda"><i
                            class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/user/delate/' . $row['id']); ?>" class="btn btn-danger"><i
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


<?= $this->endSection() ?>