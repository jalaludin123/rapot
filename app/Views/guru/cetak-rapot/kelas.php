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
              <?php foreach ($kelas as $kelas) { ?>
              <?php if ($kelas['id_kelas'] == session()->get('id_kelas')) { ?>
              <form action="<?= base_url('guru/rapot/getData/'); ?>" method="post">
                <input type="hidden" name="kelas" value="<?= $kelas['id_kelas']; ?>">
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
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>