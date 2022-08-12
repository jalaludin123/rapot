<?= $this->extend("template/layout-walikelas") ?>
<?= $this->section("body") ?>
<div class="main-pages">
  <div class="container-fluid">
    <div class="row g-2 mb-3">
      <div class="col-12">
        <div class="d-block bg-white rounded shadow p-3">
          <div class="card">
            <div class="card-header head-card">
              <b class="title-card"><?= $title; ?></b>
              <?php
              $id_kelas = isset($siswa['id_kelas']) ? $siswa['id_kelas'] : '';
              $id_semester = isset($semester['id_semester']) ? $semester['id_semester'] : '';
              $id_siswa = isset($siswa['id_siswa']) ? $siswa['id_siswa'] : '';
              ?>
              <a href="<?= base_url('guru/rapot/kelasSiswa/' . $id_kelas . '/' . $id_semester . '/' . $tahun['id_thn']); ?>"
                class="btn btn-primary"><i class="fa fa-backward"></i> Back</a>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <table class="table table-borderless">
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= isset($siswa['nama_siswa']) ? $siswa['nama_siswa'] : ''; ?>"
                          disabled readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Kelas</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= isset($siswa['kls']) ? $siswa['kls'] : ''; ?>" disabled readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Wali Kelas</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= $users['nama']; ?>" disabled readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Semester</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= isset($semester['semester']) ? $semester['semester'] : ''; ?>"
                          disabled>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table table-borderless">
                    <tr>
                      <td>NISN</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= isset($siswa['nisn']) ? $siswa['nisn'] : ''; ?>" disabled
                          readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Kelas</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= isset($siswa['nama_kelas']) ? $siswa['nama_kelas'] : ''; ?>"
                          disabled readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Nip</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= $users['nip']; ?>" disabled readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Tahun</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= $tahun['thn_ajaran']; ?>" disabled readonly>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <ul class="nav nav-tabs mt-3">
              <li class="nav-item menu-item">
                <a class="nav-link menu-link"
                  href="<?= base_url('guru/rapot/lihat/' . $siswa['id_siswa'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"><b>Nilai</b></a>
              </li>
              <li class="nav-item menu-item">
                <a class="nav-link menu-link"
                  href="<?= base_url('guru/rapot/lihat_absen/' . $siswa['id_siswa'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"><b>Keterampilan</b></a>
              </li>
            </ul>
            <div class="card-nav">
              <div class="card mt-4">
                <h6 class="card-header"><b>1. Penilaian Kegiatan</b></h6>
                <div class="card-body card-absen">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Predikat Kegiatan</th>
                        <th>Keterangan Kegiatan</th>
                        <th>Nama Prestasi</th>
                        <th>Leterangan Prestasi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($kegiatan as $kgt) { ?>
                      <tr>
                        <td><?= $no++, '.'; ?></td>
                        <td><?= $kgt['nama_kgt']; ?></td>
                        <td><?= $kgt['predikat_kgt']; ?></td>
                        <td><?= $kgt['keterangan_kgt']; ?></td>
                        <td><?= $kgt['nama_prs']; ?></td>
                        <td><?= $kgt['keterangan_prs']; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card mt-4">
                <h6 class="card-header"><b>2. Penilaian Sikap</b></h6>
                <div class="card-body card-absen">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th class="form-sikap">Nama Sikap
                        </th>
                        <th class="form-sikap">Predikat Sikap </th>
                        <th class="form-sikap">Deskripsi Sikap </th>
                      </tr>
                    </thead>
                    </form>
                    <tbody>
                      <?php $no = 1;
                      foreach ($sikap as $sp) { ?>
                      <tr>
                        <td><?= $no++, '.'; ?></td>
                        <td><?= $sp['nama_sikap']; ?></td>
                        <td><?= $sp['predikat_sp']; ?></td>
                        <td><?= $sp['deskripsi_sp']; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card mt-4">
                <h6 class="card-header"><b>3. Penilaian Absensi</b></h6>
                <div class="card-body card-absen">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th class="form-absen">Jenis Kehadiran</th>
                        <th class="form-absen">Jumlah Kehadiran</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($absensi as $absen) { ?>
                      <tr>
                        <td><?= $no++, '.'; ?></td>
                        <td><?= $absen['jenis_hdr']; ?></td>
                        <td><?= $absen['jumlah']; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    </form>
                  </table>
                </div>
              </div>
              <div class="card mt-4">
                <h6 class="card-header"><b>4. Catatan Wali Kelas</b></h6>
                <div class="card-body card-absen">
                  <table class="table table-bordered">
                    <tr>
                      <div class="catatan">
                        <textarea name="catatan" rows="8" class="form-control"
                          readonly><?= isset($catatan['catatan']) ? $catatan['catatan'] : ''; ?></textarea>
                      </div>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>