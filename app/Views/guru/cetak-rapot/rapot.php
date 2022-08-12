<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('assets/assets/app/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/assets/DataTables/css/jquery.dataTables.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/assets/icons/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/index.css'); ?>">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <title>Document</title>
  <script>
  window.print();
  </script>
</head>

<body>
  <div class="content_sikap">
    <div class="row rapot">
      <div class="col-8">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>Nama Sekolah</td>
              <td>:</td>
              <td><?= $setting['nama_sekolah']; ?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td><?= $setting['alamat_sekolah']; ?></td>
            </tr>
            <tr>
              <td>Nama Peserta Didik</td>
              <td>:</td>
              <td><?= $siswa['nama_siswa']; ?></td>
            </tr>
            <tr>
              <td>Nomor Induk Siswa</td>
              <td>:</td>
              <td><?= $siswa['nis']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-4">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>Kelas</td>
              <td>:</td>
              <td>Kelas <?= $siswa['kls']; ?></td>
            </tr>
            <tr>
              <td>Nama Kelas</td>
              <td>:</td>
              <td>Kelas <?= $siswa['nama_kelas']; ?></td>
            </tr>
            <tr>
              <td>Tahun</td>
              <td>:</td>
              <td><?= $tahun['thn_ajaran']; ?></td>
            </tr>
            <tr>
              <td>Semester</td>
              <td>:</td>
              <td>Semester <?= $semester['semester']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="garis_td"></div>
    </div>
    <div class="judul_rapot">
      <h5><b>PENCAPAIAN KOMPETENSI PESERTA DIDIK</b></h5>
    </div>
    <div class="main_rapot mt-3">
      <h5><b> A. Sikap</b></h5>
      <div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nama Sikap</th>
              <th>Predikat</th>
              <th>Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sikap as $skp) { ?>
            <tr>
              <td><?= $skp['nama_sikap']; ?></td>
              <td><?= $skp['predikat_sp']; ?></td>
              <td><?= $skp['deskripsi_sp']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="main_rapot mt-2">
      <h5><b> B. Estrakurikuler</b></h5>
      <div class="title_rapot">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Kegiatan Estrakurikuler</th>
              <th>Predikat</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($eskul as $kegiatan) { ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $kegiatan['nama_kgt']; ?></td>
              <td><?= $kegiatan['predikat_kgt']; ?></td>
              <td><?= $kegiatan['keterangan_kgt']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="main_rapot mt-2">
      <h5><b> C. Prestasi</b></h5>
      <div class="title_rapot">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Jenis Prestasi</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($eskul as $kegiatan) { ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $kegiatan['nama_prs']; ?></td>
              <td><?= $kegiatan['keterangan_prs']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tanggal_rapot">
      <?php $tanggal = date('d M Y');
      ?>
      <p><span>Kosambi,</span> <?php echo $tanggal; ?></p>
      <p class="nama_paragraf">Wali Kelas</p>
      <br>
      <p><b><?= $users['nama']; ?></b>
      <div class="garis_paragraf"></div>
      <p>NIP. <?= $users['nip']; ?></p>
      </p>
    </div>
  </div>
  <div class="content_sikap">
    <div class="row rapot">
      <div class="col-8">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>Nama Sekolah</td>
              <td>:</td>
              <td><?= $setting['nama_sekolah']; ?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td><?= $setting['alamat_sekolah']; ?></td>
            </tr>
            <tr>
              <td>Nama Peserta Didik</td>
              <td>:</td>
              <td><?= $siswa['nama_siswa']; ?></td>
            </tr>
            <tr>
              <td>Nomor Induk Siswa</td>
              <td>:</td>
              <td><?= $siswa['nis']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-4">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>Kelas</td>
              <td>:</td>
              <td>Kelas <?= $siswa['kls']; ?></td>
            </tr>
            <tr>
              <td>Nama Kelas</td>
              <td>:</td>
              <td>Kelas <?= $siswa['nama_kelas']; ?></td>
            </tr>
            <tr>
              <td>Tahun</td>
              <td>:</td>
              <td><?= $tahun['thn_ajaran']; ?></td>
            </tr>
            <tr>
              <td>Semester</td>
              <td>:</td>
              <td>Semester <?= $semester['semester']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="garis_td"></div>
    </div>
    <div class="main_rapot mt-2">
      <h5><b>D. Pengetahuan Dan Keterampilan</b></h5>
      <div class="title_rapot">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th rowspan="2" class="text-center">No</th>
              <th rowspan="2" class="text-center">Mata Pelajaran</th>
              <th rowspan="2" class="text-center">KKM</th>
              <th colspan="3" class="text-center">Pengetahuan Dan Keterampilan</th>
            </tr>
            <tr>
              <th class="text-center">Nilai</th>
              <th class="text-center">Predikat</th>
              <th class="text-center">Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($nilais as $nilai) { ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $nilai['nama_mapel']; ?></td>
              <td><?= $nilai['kkm']; ?></td>
              <td><?= $nilai['nilai']; ?></td>
              <td><?= $nilai['predikat']; ?></td>
              <td><?= $nilai['deskripsi']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tanggal_rapot">
      <?php $tanggal = date('d M Y');
      ?>
      <p><span>Kosambi,</span> <?php echo $tanggal; ?></p>
      <p class="nama_paragraf">Wali Kelas</p>
      <br>
      <p><b><?= $users['nama']; ?></b>
      <div class="garis_paragraf"></div>
      <p>NIP. <?= $users['nip']; ?></p>
      </p>
    </div>
  </div>
  <div class="content_sikap">
    <div class="row rapot">
      <div class="col-8">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>Nama Sekolah</td>
              <td>:</td>
              <td><?= $setting['nama_sekolah']; ?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td><?= $setting['alamat_sekolah']; ?></td>
            </tr>
            <tr>
              <td>Nama Peserta Didik</td>
              <td>:</td>
              <td><?= $siswa['nama_siswa']; ?></td>
            </tr>
            <tr>
              <td>Nomor Induk Siswa</td>
              <td>:</td>
              <td><?= $siswa['nis']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-4">
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>Kelas</td>
              <td>:</td>
              <td>Kelas <?= $siswa['kls']; ?></td>
            </tr>
            <tr>
              <td>Nama Kelas</td>
              <td>:</td>
              <td>Kelas <?= $siswa['nama_kelas']; ?></td>
            </tr>
            <tr>
              <td>Tahun</td>
              <td>:</td>
              <td><?= $tahun['thn_ajaran']; ?></td>
            </tr>
            <tr>
              <td>Semester</td>
              <td>:</td>
              <td>Semester <?= $semester['semester']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="garis_td"></div>
    </div>
    <div class="main_rapot mt-2">
      <h5><b>E.Absensi</h5></b>
      <div class="title_rapot">
        <table class="table table-bordered">
          <tbody>
            <?php foreach ($absens as $absen) { ?>
            <tr>
              <td><?= $absen['jenis_hdr']; ?></td>
              <td><?= $absen['jumlah']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="main_rapot mt-2">
      <h5><b>F.Catatan Wali Kelas</h5></b>
      <div class="title_rapot">
        <textarea rows="4" class="form-control"
          disabled><?= isset($catatan['catatan']) ? $catatan['catatan'] : ''; ?></textarea>
      </div>
    </div>
    <div class="main_rapot mt-2">
      <h5><b>G.Tanggapan Orang Tua/Wali</h5></b>
      <div class="title_rapot">
        <textarea rows="4" class="form-control"></textarea>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-6">
        <div class="tanggal_rp">
          <p>Mengetahui</p>
          <p class="nm_paraf">Orang Tua/Wali</p>
          <br>
          <p>.........................</p>
        </div>
      </div>
      <div class="col-6">
        <div class="tanggal_rpt">
          <?php $tanggal = date('d M Y');
          ?>
          <p><span>Kosambi,</span> <?php echo $tanggal; ?></p>
          <p class="nama_paragraf">Wali Kelas</p>
          <br>
          <p><b><?= $users['nama']; ?></b>
          <div class="garis_paragraf"></div>
          <p>NIP. <?= $users['nip']; ?></p>
          </p>
        </div>
      </div>
    </div>
    <div class="kps">
      <p>Mengetahui</p>
      <p class="nama_paragraf">Kepala Sekolah</p>
      <br>
      <p><b><?= $setting['kepala_sekolah']; ?></b>
      <div class="garis_paragraf"></div>
      <p>NIP. <?= $setting['nip_kepsek']; ?></p>
      </p>
    </div>
  </div>


  <script src="<?= base_url('assets/dist/js/jquery.js'); ?>"></script>
  <script src="<?= base_url('assets/assets/app/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/dist/js/index.js'); ?>"></script>
  <script src="<?= base_url('assets/assets/DataTables/js/jquery.dataTables.min.js'); ?>"></script>
</body>

</html>