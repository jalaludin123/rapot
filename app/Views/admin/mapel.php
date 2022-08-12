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
              <?php $validation = \Config\Services::validation(); ?>
              <?php
              if ($validation->getError('kode_mapel')) {
                echo '<div class="alert alert-danger alert-dismissible fade show auto-close" role="alert">
                                <strong>';
                echo $validation->getError('kode_mapel');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }

              if ($validation->getError('nama_mapel')) {
                echo '<div class="alert alert-danger alert-dismissible fade show auto-close" role="alert">
                                <strong>';
                echo $validation->getError('nama_mapel');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }

              if (session()->getFlashData('success')) {
                echo '<div class="alert alert-success alert-dismissible fade show auto-close" role="alert">
                                <strong>';
                echo session()->getFlashdata('success');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }
              if (session()->getFlashData('edit')) {
                echo '<div class="alert alert-success alert-dismissible fade show auto-close" role="alert">
                                <strong>';
                echo session()->getFlashdata('edit');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }
              if (session()->getFlashData('hapus')) {
                echo '<div class="alert alert-success alert-dismissible fade show auto-close" role="alert">
                                <strong>';
                echo session()->getFlashdata('hapus');
                echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              }
              ?>
              <div class="table-responsive">
                <table id="example" class="display">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Mata Pelajaran</th>
                      <th>Nama Mata pelajaran</th>
                      <th>Kelas</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($mapel as $row) {
                    ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $row['kode_mapel']; ?></td>
                      <td><?= $row['nama_mapel']; ?></td>
                      <td><?= $row['kls']; ?></td>
                      <td class="adm_td">
                        <a href="" class="btn btn-warning adm_tda" data-bs-toggle="modal"
                          data-bs-target="#edit<?= $row['id_mapel']; ?>"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/mapel/delate/' . $row['id_mapel']); ?>"
                          class="btn btn-danger adm_tda delate"><i class="fa fa-trash"></i></a>
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
    <form action="<?= base_url('admin/mapel/insert'); ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data <?= $title; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 row">
            <label for="kode" class="col-sm-4 col-form-label">Kode Mapel</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="kode" name="kode_mapel"
                placeholder="Masukan Kode Mata Pelajaran" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="Kelas" class="col-sm-4 col-form-label">Nama Mapel</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama_mapel" id="Kelas"
                placeholder="Masukan Nama Mata Pelajaran" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="Kls" class="col-sm-4 col-form-label">Kelas</label>
            <div class="col-sm-8">
              <select name="id_kls" id="Kls" class="form-select" aria-label="Default select example">
                <option>
                  <--Pilih Kelas-->
                </option>
                <?php foreach ($kls as $arr) { ?>
                <option value="<?= $arr['id_kls']; ?>"><?= $arr['kls']; ?></option>
                <?php } ?>
              </select>
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

<!-- Modal edit-->
<?php foreach ($mapel as $row) { ?>
<div class="modal fade" id="edit<?= $row['id_mapel']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/mapel/edit/' . $row['id_mapel']); ?>" method="POST">
      <input type="hidden" name="id" value="<?= $row['id_mapel']; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data<?= $title; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 row">
            <label for="Kelas" class="col-sm-4 col-form-label">Kode Mapel</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama_mapel" value="<?= $row['kode_mapel']; ?>" id="Kelas"
                placeholder="Masukan Kelas" required readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="Kelas" class="col-sm-4 col-form-label">Nama Mapel</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama_mapel" value="<?= $row['nama_mapel']; ?>" id="Kelas"
                placeholder="Masukan Kelas" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="Kls" class="col-sm-4 col-form-label">Kelas</label>
            <div class="col-sm-8">
              <select name="id_kls" id="Kls" class="form-select" aria-label="Default select example">
                <option value="<?= $row['id_kls']; ?>"><?= $row['kls']; ?></option>
                <?php foreach ($kls as $arr) { ?>
                <option value="<?= $arr['id_kls']; ?>"><?= $arr['kls']; ?></option>
                <?php } ?>
              </select>
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