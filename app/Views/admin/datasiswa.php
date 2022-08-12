<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="card">
            <h5 class="card-header"><?= $title; ?> <?= $kelas['nama_kelas']; ?></h5>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="display">
                  <thead>
                    <tr>
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
                    foreach ($siswa as $student) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $student['nama_siswa']; ?></td>
                      <td><?= $student['nis']; ?></td>
                      <td><?= $student['nisn']; ?></td>
                      <td>
                        <a href="<?= base_url('admin/laporan/lihat_nilai/' . $student['id_siswa'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"
                          class="btn btn-primary"><i class="fa fa-eye"></i></a>
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