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
              <a href="<?= base_url('guru/nilai/siswa/' . $id_kelas . '/' . $id_semester . '/' . $tahun['id_thn']); ?>"
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
            <?php $validation = \Config\Services::validation(); ?>
            <?php
            if (session()->getFlashData('berhasil')) {
              echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                                <strong>';
              echo session()->getFlashdata('berhasil');
              echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
            if (session()->getFlashData('edit')) {
              echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                                <strong>';
              echo session()->getFlashdata('edit');
              echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
            if (session()->getFlashData('hapus')) {
              echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                                <strong>';
              echo session()->getFlashdata('hapus');
              echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
            ?>
            <ul class="nav nav-tabs mt-3">
              <li class="nav-item menu-item">
                <a class="nav-link menu-link"
                  href="<?= base_url('guru/nilai/inputNilai/' . $siswa['id_siswa'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"><b>Nilai</b></a>
              </li>
              <li class="nav-item menu-item">
                <a class="nav-link menu-link"
                  href="<?= base_url('guru/nilai/inputData/' . $siswa['id_siswa'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"><b>Keterampilan</b></a>
              </li>
            </ul>
            <div class="card-nav">
              <div class="card mt-4">
                <h6 class="card-header"><b>1. Penilaian Kegiatan</b></h6>
                <div class="card-body card-absen">
                  <table class="table table-bordered">
                    <form action="<?= base_url('guru/nilai/kegiatan'); ?>" method="post">
                      <input type="hidden" name="siswa" value="<?= $id_siswa ?>">
                      <input type="hidden" name="semester" value="<?= $id_semester ?>">
                      <input type="hidden" name="tahun" value="<?= $tahun['id_thn'] ?>">
                      <thead>
                        <tr>
                          <th class="no-penilaian">No</th>
                          <th>
                            <input type="text" name="nama_kgt"
                              class="form-control form <?= $validation->hasError('nama_kgt') ? 'is-invalid' : null; ?>"
                              placeholder="Nama Kegiatan">
                            <div class="invalid-feedback">
                              <?= $validation->getError('nama_kgt') ?>
                            </div>
                          </th>
                          <th>
                            <input type="text" name="predikat_kgt"
                              class="form-control form <?= $validation->hasError('predikat_kgt') ? 'is-invalid' : null; ?>"
                              placeholder="Predikat kegiatan">
                            <div class="invalid-feedback">
                              <?= $validation->getError('predikat_kgt') ?>
                            </div>
                          </th>
                          <th>
                            <textarea name="keterangan_kgt" rows="1"
                              class="form-control form <?= $validation->hasError('keterangan_kgt') ? 'is-invalid' : null; ?>"
                              placeholder="Deskripsi Kegiatan"></textarea>
                            <div class="invalid-feedback">
                              <?= $validation->getError('keterangan_kgt') ?>
                            </div>
                          </th>
                          <th>
                            <input type="text" name="nama_prs"
                              class="form-control form  <?= $validation->hasError('nama_prs') ? 'is-invalid' : null; ?>"
                              placeholder="Nama Prestasi">
                            <div class="invalid-feedback">
                              <?= $validation->getError('nama_prs') ?>
                            </div>
                          </th>
                          <th>
                            <textarea name="keterangan_prs" rows="1"
                              class="form-control form  <?= $validation->hasError('keterangan_prs') ? 'is-invalid' : null; ?>"
                              placeholder="Keterangan Prestasi"></textarea>
                            <div class="invalid-feedback">
                              <?= $validation->getError('keterangan_prs') ?>
                            </div>
                          </th>
                          <th>
                            <button class="btn btn-primary btn_kegiatan" type="submit"> <i class="fa fa-save"></i>
                              Save</button>
                          </th>
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
                          <td>
                            <a href="<?= base_url('guru/nilai/hapus_kegiatan/' . $kgt['id_kegiatan'] . '/' . $id_siswa . '/' . $id_semester . '/' . $tahun['id_thn']); ?>"
                              class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </form>
                  </table>
                </div>
              </div>
              <div class="card mt-4">
                <h6 class="card-header"><b>2. Penilaian Sikap</b></h6>
                <div class="card-body card-absen">
                  <table class="table table-bordered">
                    <form action="<?= base_url('guru/nilai/sikap'); ?>" method="POST">
                      <input type="hidden" name="siswa" value="<?= $id_siswa ?>">
                      <input type="hidden" name="semester" value="<?= $id_semester ?>">
                      <input type="hidden" name="tahun" value="<?= $tahun['id_thn'] ?>">
                      <thead>
                        <tr>
                          <th class="no-penilaian">No</th>
                          <th class="form-sikap">
                            <select name="nama_sikap" id="Sikap"
                              class="form-control form <?= $validation->hasError('nama_sikap') ? 'is-invalid' : null; ?>">
                              <option value="">-- Pilih Sikap --</option>
                              <option value="Spiritual">Spiritual</option>
                              <option value="Sosial">Sosial</option>
                            </select>
                            <div class="invalid-feedback">
                              <?= $validation->getError('nama_sikap') ?>
                            </div>
                          </th>
                          <th class="form-sikap">
                            <input type="text" name="predikat_sp"
                              class="form-control form <?= $validation->hasError('predikat_sp') ? 'is-invalid' : null; ?>"
                              placeholder="Predikat Sikap">
                            <div class="invalid-feedback">
                              <?= $validation->getError('predikat_sp') ?>
                            </div>
                          </th>
                          <th class="form-sikap">
                            <textarea name="deskripsi_sp" rows="1"
                              class="form-control form <?= $validation->hasError('deskripsi_sp') ? 'is-invalid' : null; ?>"
                              placeholder="Deskripsi Sikap"></textarea>
                            <div class="invalid-feedback">
                              <?= $validation->getError('deskripsi_sp') ?>
                            </div>
                          </th>
                          <th>
                            <button class="btn btn-primary btn_kegiatan" type="submit"> <i class="fa fa-save"></i>
                              Save</button>
                          </th>
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
                        <td>
                          <a href="<?= base_url('guru/nilai/hapus_sikap/' . $sp['id_sikap'] . '/' . $id_siswa . '/' . $id_semester . '/' . $tahun['id_thn']); ?>"
                            class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                        </td>
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
                    <form action="<?= base_url('guru/nilai/absen'); ?>" method="post">
                      <input type="hidden" name="siswa" value="<?= $id_siswa ?>">
                      <input type="hidden" name="semester" value="<?= $id_semester ?>">
                      <input type="hidden" name="tahun" value="<?= $tahun['id_thn'] ?>">
                      <thead>
                        <tr>
                          <th class="no-penilaian">No</th>
                          <th class="form-absen">
                            <select name="jenis_hdr" id="Hadir"
                              class="form-control form <?= $validation->hasError('jenis_hdr') ? 'is-invalid' : null; ?>">
                              <option value="">-- Jenis Ketidakhadiran --</option>
                              <option value="Sakit">Sakit</option>
                              <option value="Izin">Izin</option>
                              <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                            </select>
                            <div class="invalid-feedback">
                              <?= $validation->getError('jenis_hdr') ?>
                            </div>
                          </th>
                          <th class="form-absen">
                            <input type="text" name="jumlah"
                              class="form-control form <?= $validation->hasError('jumlah') ? 'is-invalid' : null; ?>"
                              placeholder="Jumlah Kehadiran">
                            <div class="invalid-feedback">
                              <?= $validation->getError('jumlah') ?>
                            </div>
                          </th>
                          <th>
                            <button class="btn btn-primary btn_kegiatan" type="submit"> <i class="fa fa-save"></i>
                              Save</button>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        foreach ($absensi as $absen) { ?>
                        <tr>
                          <td><?= $no++, '.'; ?></td>
                          <td><?= $absen['jenis_hdr']; ?></td>
                          <td><?= $absen['jumlah']; ?></td>
                          <td>
                            <a href="<?= base_url('guru/nilai/hapus_absen/' . $absen['id_hdr'] . '/'  . $id_siswa . '/' . $id_semester . '/' . $tahun['id_thn']); ?>"
                              class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                          </td>
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
                  <?php $cek = isset($catatan['id_siswa']) ? $catatan['id_siswa'] : '';
                  if ($cek != $siswa['id_siswa']) { ?>
                  <table class="table table-bordered">
                    <form action="<?= base_url('guru/nilai/catatan'); ?>" method="post">
                      <input type="hidden" name="siswa" value="<?= $id_siswa ?>">
                      <input type="hidden" name="semester" value="<?= $id_semester ?>">
                      <input type="hidden" name="tahun" value="<?= $tahun['id_thn'] ?>">
                      <thead>
                        <tr>
                          <div class="catatan">
                            <textarea name="catatan" rows="8"
                              class="form-control form <?= $validation->hasError('catatan') ? 'is-invalid' : null; ?>"></textarea>
                            <div class="invalid-feedback">
                              <?= $validation->getError('catatan') ?>
                            </div>
                          </div>
                          <div class="btn-catatan mt-3 btn-catatan">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                          </div>
                        </tr>
                      </thead>
                    </form>
                  </table>
                  <?php } else { ?>
                  <table class="table table-bordered">
                    <tr>
                      <div class="catatan">
                        <textarea name="catatan" rows="8" class="form-control"
                          readonly><?= isset($catatan['catatan']) ? $catatan['catatan'] : ''; ?></textarea>
                      </div>
                      <div class="btn-catatan mt-3 btn-catatan">
                        <a href="<?= base_url('guru/nilai/hapus_catatan/' . $catatan['id_catatan'] . '/' . $id_siswa . '/' . $id_semester . '/' . $tahun['id_thn']); ?>"
                          class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                      </div>
                    </tr>
                  </table>
                  <?php } ?>
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