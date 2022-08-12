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
              <div class="table-responsive">
                <table id="example" class="display">
                  <thead>
                    <tr class="table-siswa">
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>NIS</th>
                      <th>NISN</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($kelas as $siswa) { ?>

                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $siswa['nama_siswa']; ?></td>
                      <td><?= $siswa['nis']; ?></td>
                      <td><?= $siswa['nisn']; ?></td>
                      <td>
                        <a href="<?= base_url('guru/nilai/inputNilai/' . $siswa['id_siswa'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"
                          class="btn btn-primary"><i class="fa fa-pencil-square"></i></a>
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