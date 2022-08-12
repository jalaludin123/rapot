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
              <a href="<?= base_url('guru/nilai/siswa/' . $siswa['id_kelas'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"
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
                        <input type="text" value="<?= $siswa['nama_siswa']; ?>" disabled readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Kelas</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= $siswa['kls']; ?>" disabled readonly>
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
                        <input type="text" value="<?= $semester['semester']; ?>" disabled>
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
                        <input type="text" value="<?= $siswa['nisn']; ?>" disabled readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Kelas</td>
                      <td>:</td>
                      <td>
                        <input type="text" value="<?= $siswa['nama_kelas']; ?>" disabled readonly>
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
            ?>
            <ul class="nav nav-tabs">
              <li class="nav-item menu-item">
                <a class="nav-link menu-link"
                  href="<?= base_url('guru/nilai/inputNilai/' . $siswa['id_siswa'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"><b>Nilai</b></a>
              </li>
              <li class="nav-item menu-item">
                <a class="nav-link menu-link"
                  href="<?= base_url('guru/nilai/inputData/' . $siswa['id_siswa'] . '/' . $semester['id_semester'] . '/' . $tahun['id_thn']); ?>"><b>Keterampilan</b></a>
              </li>
            </ul>
            <div class="card-body mt-2">
              <?php if ($getSemester != $semester['id_semester']) { ?>
              <form action="<?= base_url('guru/nilai/save_nilai/') ?>" method="post">
                <input type="hidden" name="kelas" value="<?= $siswa['id_kelas']; ?>">
                <input type="hidden" name="siswa" value="<?= $siswa['id_siswa']; ?>">
                <input type="hidden" name="semester" value="<?= $semester['id_semester']; ?>">
                <input type="hidden" name="tahun" value="<?= $tahun['id_thn']; ?>">
                <input type="hidden" name="kls" value="<?= $siswa['id_kls']; ?>">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="nilai-style">
                        <th rowspan="2" class="text-center" width="35">NO</th>
                        <th rowspan="2" class="text-center" width="85">Kode</th>
                        <th rowspan="2" class="text-center" width="300">Mata nilai</th>
                        <th rowspan="2" class="text-center" width="95">KKM</th>
                        <th rowspan="2" class="text-center" width="95">RNT</th>
                        <th rowspan="2" class="text-center" width="95">RNU</th>
                        <?php if ($semester['id_semester'] == 1) { ?>
                        <th rowspan=" 2" class="text-center" width="95">PTS</th>
                        <?php } else { ?>
                        <th rowspan="2" class="text-center" width="95">PTS</th>
                        <th rowspan="2" class="text-center" width="95">UAS</th>
                        <?php } ?>
                        <th rowspan="2" class="text-center" width="95">NA</th>
                        <th rowspan="2" class="text-center" width="85">GRADE</th>
                        <th rowspan="2" class="text-center" width="250">DESKRIPSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1;
                        foreach ($mapel as $nilai) { ?>
                      <input type="hidden" name="id_siswa<?= $nilai['id_mapel']; ?>" value="<?= $siswa['id_siswa']; ?>">
                      <input type="hidden" name="nama_kelas<?= $nilai['id_mapel']; ?>"
                        value="<?= $siswa['nama_kelas']; ?>">
                      <input type="hidden" name="id<?= $nilai['id_mapel']; ?>" value="<?= $users['id']; ?>">
                      <input type="hidden" name="id_semester<?= $nilai['id_mapel']; ?>"
                        value="<?= $semester['id_semester']; ?>">
                      <input type="hidden" name="id_thn<?= $nilai['id_mapel']; ?>" value="<?= $tahun['id_thn']; ?>">
                      <input type="hidden" name="id_mapel<?= $nilai['id_mapel']; ?>" value="<?= $nilai['id_mapel']; ?>">

                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $nilai['kode_mapel']; ?></td>
                        <td><?= $nilai['nama_mapel']; ?></td>
                        <td>
                          <input type="number" name="kkm<?= $nilai['id_mapel']; ?>" id="kkm" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)" required>
                        </td>
                        <td>
                          <input type="number" name="tp1<?= $nilai['id_mapel']; ?>" id="tp1"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai1('tp', <?= $nilai['id_mapel']; ?>)" class="form-control"
                            onclick="dropreadonly('tp1<?= $nilai['id_mapel']; ?>')" required>
                        </td>
                        <td>
                          <input type="number" name="tp2<?= $nilai['id_mapel']; ?>" id="tp2" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai2('tp',<?= $nilai['id_mapel']; ?>)"
                            onclick="dropreadonly('tp2<?= $nilai['id_mapel']; ?>')" required>
                        </td>
                        <?php
                            if ($semester['id_semester'] == 1) { ?>
                        <td>
                          <input type="number" name="tp3<?= $nilai['id_mapel']; ?>" id="tp3" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai3('tp',<?= $nilai['id_mapel']; ?>)"
                            onclick="dropreadonly('tp3<?= $nilai['id_mapel']; ?>')" required>
                        </td>
                        <?php } else { ?>
                        <td>
                          <input type="number" name="tp3<?= $nilai['id_mapel']; ?>" id="tp3" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai3('tp',<?= $nilai['id_mapel']; ?>)"
                            onclick="dropreadonly('tp3<?= $nilai['id_mapel']; ?>')" required>
                        </td>
                        <td>
                          <input type="number" name="tp4<?= $nilai['id_mapel']; ?>" id="tp4" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai4('tp',<?= $nilai['id_mapel']; ?>)" required>
                        </td>
                        <?php } ?>
                        <td>
                          <input type="number" name="rata_tp<?= $nilai['id_mapel']; ?>" id="rata_tp"
                            class="form-control" style="width:80px;" readonly>
                        </td>
                        <td>
                          <input type="text" name="predikat<?= $nilai['id_mapel']; ?>" id="predikat"
                            class="form-control" readonly>
                        </td>
                        <td>
                          <input type="text" name="deskripsi<?= $nilai['id_mapel']; ?>" id="deskripsi"
                            class="form-control" readonly>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <div class="ibox-content mt-3">
                    <button type="submit" class="btn btn-dark button btn-nilai">save</button>
                  </div>
                </div>
              </form>
              <?php } else { ?>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2" class="text-center" width="35" style="line-height:55px;">NO</th>
                      <th rowspan="2" class="text-center" width="85" style="line-height:55px;">Kode</th>
                      <th rowspan="2" class="text-center" width="300" style="line-height:55px;">Mata nilai</th>
                      <th rowspan="2" class="text-center" width="95" style="line-height:55px;">KKM</th>
                      <th rowspan="2" class="text-center" width="95" style="line-height:55px;">RNT</th>
                      <th rowspan="2" class="text-center" width="95" style="line-height:55px;">RNU</th>
                      <?php if ($semester['id_semester'] == 1) { ?>
                      <th rowspan=" 2" class="text-center" width="95" style="line-height:55px;">PTS</th>
                      <?php } else { ?>
                      <th rowspan="2" class="text-center" width="95" style="line-height:55px;">PTS</th>
                      <th rowspan="2" class="text-center" width="95" style="line-height:55px;">UAS</th>
                      <?php } ?>
                      <th rowspan="2" class="text-center" width="95" style="line-height:55px;">NA</th>
                      <th rowspan="2" class="text-center" width="85" style="line-height:55px;">GRADE</th>
                      <th rowspan="2" class="text-center" width="250" style="line-height:55px;">DESKRIPSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                      foreach ($nilai as $nilai) { ?>
                    <form action="<?= base_url('guru/nilai/updateNilai/' . $nilai['id_siswa']) ?>" method="post">
                      <input type="hidden" name="id_nilai<?= $nilai['id_mapel']; ?>" value="<?= $nilai['id_nilai']; ?>">
                      <input type="hidden" name="id_semester" value="<?= $nilai['id_semester']; ?>">
                      <input type="hidden" name="id_thn" value="<?= $nilai['id_thn']; ?>">
                      <input type="hidden" name="id_siswa" value="<?= $nilai['id_siswa']; ?>">
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $nilai['kode_mapel']; ?></td>
                        <td><?= $nilai['nama_mapel']; ?></td>
                        <td>
                          <input type="number" name="kkm<?= $nilai['id_mapel']; ?>" id="kkm" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            value="<?= isset($nilai['kkm']) ? $nilai['kkm'] : ''; ?>" required>
                        </td>
                        <td>
                          <input type="number" name="tp1<?= $nilai['id_mapel']; ?>" id="tp1"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai1('tp', <?= $nilai['id_mapel']; ?>)" class="form-control"
                            onclick="dropreadonly('tp1<?= $nilai['id_mapel']; ?>')"
                            value="<?= isset($nilai['nilai_tgs']) ? $nilai['nilai_tgs'] : ''; ?>" required>
                        </td>
                        <td>
                          <input type="number" name="tp2<?= $nilai['id_mapel']; ?>" id="tp2" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai2('tp',<?= $nilai['id_mapel']; ?>)"
                            onclick="dropreadonly('tp2<?= $nilai['id_mapel']; ?>')"
                            value="<?= isset($nilai['nilai_nu']) ? $nilai['nilai_nu'] : ''; ?>" required>
                        </td>
                        <?php
                            if ($semester['id_semester'] == 1) { ?>
                        <td>
                          <input type="number" name="tp3<?= $nilai['id_mapel']; ?>" id="tp3" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai3('tp',<?= $nilai['id_mapel']; ?>)"
                            onclick="dropreadonly('tp3<?= $nilai['id_mapel']; ?>')"
                            value="<?= isset($nilai['nilai_pts']) ? $nilai['nilai_pts'] : ''; ?>" required>
                        </td>
                        <?php } else { ?>
                        <td>
                          <input type="number" name="tp3<?= $nilai['id_mapel']; ?>" id="tp3" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai3('tp',<?= $nilai['id_mapel']; ?>)"
                            onclick="dropreadonly('tp3<?= $nilai['id_mapel']; ?>')"
                            value="<?= isset($nilai['nilai_pts']) ? $nilai['nilai_pts'] : ''; ?>" required>
                        </td>
                        <td>
                          <input type="number" name="tp4<?= $nilai['id_mapel']; ?>" id="tp4" class="form-control"
                            onkeyup="this.value = minmax(this.value,0,100)"
                            onchange="nilai4('tp',<?= $nilai['id_mapel']; ?>)"
                            value="<?= isset($nilai['nilai_pas']) ? $nilai['nilai_pas'] : ''; ?>" required>
                        </td>
                        <?php } ?>
                        <td>
                          <input type="number" name="rata_tp<?= $nilai['id_mapel']; ?>" id="rata_tp"
                            class="form-control" style="width:80px;"
                            value="<?= isset($nilai['nilai']) ? $nilai['nilai'] : ''; ?>" readonly>
                        </td>
                        <td>
                          <input type="text" name="predikat<?= $nilai['id_mapel']; ?>" id="predikat"
                            class="form-control" value="<?= isset($nilai['predikat']) ? $nilai['predikat'] : ''; ?>"
                            readonly>
                        </td>
                        <td>
                          <input type="text" name="deskripsi<?= $nilai['id_mapel']; ?>" id="deskripsi"
                            class="form-control" value="<?= isset($nilai['deskripsi']) ? $nilai['deskripsi'] : ''; ?>"
                            readonly>
                        </td>
                      </tr>
                      <?php } ?>
                  </tbody>
                </table>
                <div class="ibox-content mt-3">
                  <button type="submit" class="btn btn-dark button btn-nilai">Update</button>
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