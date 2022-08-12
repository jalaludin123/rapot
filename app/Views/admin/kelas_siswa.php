<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="card">
            <h5 class="card-header"><?= $title; ?></h5>
            <div class="card-body">
              <div class="row">
                <?php foreach ($kelas as $kls) { ?>
                <div class="col-md-4 box mt-3">
                  <div class="box-info">
                    <a href="<?= base_url('admin/laporan/datasiswa/' . $kls['id_kelas']); ?>"><i
                        class="fa fa-building"></i></a>
                  </div>
                  <div class="box-content">
                    <div class="box-title mt-3">
                      <span><?= $kls['kode_kelas']; ?> - Kelas <?= $kls['nama_kelas']; ?></span>
                      <span><?= $kls['nama']; ?></span>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>