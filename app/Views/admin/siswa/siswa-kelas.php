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
                                    <h2><?=$title;?></h2>
                                </div> 
                            </div>
                        </div>
                        <div class="ibox-content mt-4">
                            <table id="example" class="display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($kelasSiswa as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $i++;?></td>
                                        <td><?= $row['nama_siswa'] ;?></td>
                                        <td><?= $row['nis'] ;?></td>
                                        <td>
                                            <a href="<?= base_url('admin/siswa/detail/'. $row['id_siswa']);?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                        </td>
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