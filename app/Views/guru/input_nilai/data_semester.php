<?= $this->extend("template/layout-walikelas") ?>
<?= $this->section("body") ?>
<?php if ($ta['status'] == 1) { ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="card">
            <h3 class="card-header"><?= $title; ?></h3>
            <div class="card-body">
              <div class="mb-3 row mt-3">
                <label class="col-sm-2 col-form-label label">Kelas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form"
                    value="<?= $kelas['kode_kelas']; ?> - Kelas <?= $kelas['nama_kelas']; ?>" readonly>
                </div>
              </div>
              <div class="mb-3 row mt-3">
                <label class="col-sm-2 col-form-label label">Wali Kelas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form" value="<?= $users['nama']; ?>" readonly>
                </div>
              </div>
              <div class="mb-3 row mt-3">
                <label class="col-sm-2 col-form-label label">Semester</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form" value="<?= $semester['semester']; ?>" readonly>
                </div>
              </div>
              <div class="mb-3 row mt-3">
                <label class="col-sm-2 col-form-label label">Tahun Ajaran</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form" value="<?= $tahun['thn_ajaran']; ?>" readonly>
                </div>
              </div>
              <div class="mb-3 row mt-4 btnSave">
                <div class="btnSave">
                  <a href="<?= base_url('guru/nilai/siswa/' . $kelas['id_kelas'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"
                    class="btn btn-primary"><i class="fa fa-chevron-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="row">
            <div class="alert alert-warning alert-dismissible">
              <div class="col-md-12">
                <h5><i class="icon fa fa-exclamation-triangle"></i> Pemberitahuan!</h5>
                Maaf, Penginputan Nilai Sudah Di Tutup, Anda Tidak Dapat Melakukan Penginputan Nilai Lagi !!!
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<?= $this->endSection() ?>