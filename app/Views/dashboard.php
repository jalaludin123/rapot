<?= $this->extend("template/layout") ?>
<?= $this->section("body") ?>
        <div class="main-pages">
            <div class="container-fluid">
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <div class="d-block bg-white rounded shadow p-3">
                            <h2><?=$title;?></h2>
                            <p>SMP Yadika 10 Kosambi terletak di Jalan Salembaran Raya No.26 Kelurahan Cengklong Kecamatan Kosambi Kab. Tangerang Provinsi Banten 15212. Berdiri pada tahun 2006 saat ini dipimpin oleh Kepala Sekolah Suhut Wiratno, S.Pd.I.
SMP Yadika 10 Kosambi berharap dapat menyiapkan lulusan berkualitas dan produktif. Dengan implementasi penguatan pendidikan karakter, SMP Yadika 10 Kosambi berharap dapat membekali siswa dengan Hard Skill dan Soft Skill.
Motto kami adalah “3B (Beriman dan Bertaqwa, Berkualitas, Berjaya)”, mengandung arti bahwa kami akan membangun sebuah karakter anak bangsa yang berprestasi baik akademik maupun non akademik, dengan menjunjung tinggi nilai-nilai luhur dalam berpendidikan.</p>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2 shadow">
                            <div class="d-flex align-items-center px-2">
                               <a href="<?=base_url('admin/kelas');?>" style="color:black ;"><i class="fa fa-building float-start fa-3x py-auto" aria-hidden="true"></i></a>
                                <div class="card-body text-end">
                                    <h5 class="card-title"><?=$kelas;?></h5>
                                    <p class="card-text">Total Kelas</p>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <small class="text-start fw-bold">Your Class</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2 shadow">
                            <div class="d-flex align-items-center px-2">
                            <a href="<?=base_url('admin/siswa');?>" style="color:black ;"><i class="fa fa-users fa-3x py-auto" aria-hidden="true"></i></a>
                                <div class="card-body text-end">
                                    <h5 class="card-title"><?=$siswa;?></h5>
                                    <p class="card-text">Total Siswa</p>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <small class="text-start fw-bold">Your Student</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2 shadow">
                            <div class="d-flex align-items-center px-2">
                            <a href="<?=base_url('admin/dataguru');?>" style="color:black ;"><i class="fa fa-user-secret float-start fa-3x py-auto" aria-hidden="true"></i></a>
                                <div class="card-body text-end">
                                    <h5 class="card-title"><?=$wali;?></h5>
                                    <p class="card-text">Total Wali Kelas</p>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <small class="text-start fw-bold">Your Teacher</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="card p-2 shadow">
                            <div class="d-flex align-items-center px-2">
                            <a href="<?=base_url('admin/mapel');?>" style="color:black ;"><i class="fa fa-book float-start fa-3x py-auto" aria-hidden="true"></i></a>
                                <div class="card-body text-end">
                                    <h5 class="card-title"><?=$mapel;?></h5>
                                    <p class="card-text">Total Pelajaran</p>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <small class="text-start fw-bold">Your Lesson</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?= $this->endSection() ?>