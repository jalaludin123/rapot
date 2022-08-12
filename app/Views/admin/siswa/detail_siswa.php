<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="card">
            <h5 class="card-header"><?= $title; ?></h5>
            <?php foreach ($siswaDetail as $row) { ?>
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">Nama Siswa</label>
                    <input type="text" class="form-control form" value="<?= $row['nama_siswa']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">Agama</label>
                    <input type="text" class="form-control form" value="<?= $row['agama']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">Tempat lahir</label>
                    <input type="text" class="form-control form" value="<?= $row['tempat_lahir']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">Jenis Kelamin</label>
                    <input type="text" class="form-control form" value="<?= $row['jenis_kelamin']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">Nama Ayah</label>
                    <input type="text" class="form-control form" value="<?= $row['nama_ayah']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">No Telepon</label>
                    <input type="text" class="form-control form" value="<?= $row['no_telepon']; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">NIS</label>
                    <input type="text" class="form-control form" value="<?= $row['nis']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">NISN</label>
                    <input type="text" class="form-control form" value="<?= $row['nisn']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">Tanggal Lahir</label>
                    <input type="text" class="form-control form" value="<?= $row['tgl_lahir']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">Kelas</label>
                    <input type="text" class="form-control form" value="<?= $row['kls']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">Nama Kelas</label>
                    <input type="text" class="form-control form" value="<?= $row['nama_kelas']; ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="Siswa" class="form-label label ">Nama Ibu</label>
                    <input type="text" class="form-control form" value="<?= $row['nama_ibu']; ?>" readonly>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="Siswa" class="form-label label ">Alamat</label>
                  <textarea class="form-control form" rows="7" readonly><?= $row['alamat']; ?></textarea>
                </div>
              </div>

              <div class="row mt-4 button-row">
                <div class="col-md-12">
                  <a href="<?= base_url('admin/siswa/update/' . $row['id_siswa']); ?>"
                    class="btn btn-primary">Update</a>
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

<?= $this->endSection() ?>