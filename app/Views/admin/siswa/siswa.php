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
                  <h4><?= $title; ?></h4>
                </div>
                <div class="col-md-4">
                  <a href="<?= base_url('admin/siswa/addsiswa'); ?>" class="btn btn-primary adm_btn"
                    style="float: right;"> Tambah Siswa <i class="fa fa-plus-circle"></i></a>
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
                      <th>Nama Siswa</th>
                      <th>NIS</th>
                      <th>NISN</th>
                      <th>Kelas</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($siswa as $row) {
                    ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $row['nama_siswa']; ?></td>
                      <td><?= $row['nis']; ?></td>
                      <td><?= $row['nisn'] ?></td>
                      <td><?= $row['nama_kelas'] ?></td>
                      <td class="adm_td">
                        <a href="<?= base_url('admin/siswa/update/' . $row['id_siswa']); ?>"
                          class="btn btn-warning adm_tda"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/siswa/delate/' . $row['id_siswa']); ?>"
                          class="btn btn-danger adm_tda"><i class="fa fa-trash"></i></a>
                        <a href="<?= base_url('admin/siswa/detail/' . $row['id_siswa']); ?>"
                          class="btn btn-success adm_tda"><i class="fa fa-eye"></i></a>
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