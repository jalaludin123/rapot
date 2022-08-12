<?= $this->extend("template/layout-walikelas") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="card">
            <h3 class="card-header"><?= $title; ?></h3>
            <div class="card-body">
              <?php if ($siswa['id_kelas'] == $users['id_kelas']) { ?>
              <form action="<?= base_url('guru/nilai/inputNilai/' . $siswa['id_siswa']); ?>" method="post">
                <input type="hidden" name="kelas" value="<?= $siswa['id_kelas']; ?>">
                <input type="hidden" name="kls" value="<?= $siswa['id_kls']; ?>">
                <div class="mb-3 row mt-3">
                  <label class="col-sm-2 col-form-label label">Kelas</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form"
                      value="<?= $siswa['kode_kelas']; ?> - Kelas <?= $siswa['nama_kelas']; ?>" readonly>
                  </div>
                </div>
                <div class="mb-3 row mt-3">
                  <label class="col-sm-2 col-form-label label">Wali Kelas</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form" value="<?= $users['nama']; ?>" readonly>
                  </div>
                </div>
                <div class="mb-3 row mt-3">
                  <label class="col-sm-2 col-form-label label">Nama Siswa</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form" value="<?= $siswa['nama_siswa']; ?>" readonly>
                  </div>
                </div>
                <div class="mb-3 row mt-3">
                  <label class="col-sm-2 col-form-label label">Semester</label>
                  <div class="col-sm-10">
                    <select name="semester" class="form-control form">
                      <?php foreach ($semester as $smtr) { ?>
                      <option value="<?= $smtr['id_semester']; ?>">Semester <?= $smtr['semester']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="mb-3 row mt-3">
                  <label class="col-sm-2 col-form-label label">Tahun Ajaran</label>
                  <div class="col-sm-10">
                    <select name="tahun" class="form-control form">
                      <?php foreach ($tahun as $thn) { ?>
                      <option value="<?= $thn['id_thn']; ?>">Tahun Ajaran <?= $thn['thn_ajaran']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="mb-3 row mt-4 btnSave">
                  <div class="btnSave">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-chevron-circle-right"></i></button>
                  </div>
                </div>
              </form>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>