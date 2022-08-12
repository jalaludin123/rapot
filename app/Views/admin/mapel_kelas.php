<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="ibox-title">
            <div class="row">
              <div class="col-md-8">
                <h2><?= $title; ?></h2>
              </div>
            </div>
          </div>
          <div class="ibox-content mt-4">
            <table id="example" class="display">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Mata Pelajaran</th>
                  <th>Kode Mapel</th>
                </tr>
              </thead>
              <tbody>
                <?php
                                $i = 1;
                                foreach ($mapelKelas as $row) {
                                ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $row['nama_mapel']; ?></td>
                  <td><?= $row['kode_mapel']; ?></td>
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
<?= $this->endSection() ?>