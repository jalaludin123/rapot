<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $sub; ?></title>
  <link rel="stylesheet" href="<?= base_url('assets/assets/app/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/assets/DataTables/css/jquery.dataTables.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/assets/icons/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/index.css'); ?>">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
</head>

<body>

  <div class="wrapper">
    <nav class="navbar navbar-expand-md navbar-light py-1">
      <div class="container-fluid">
        <button class="btn btn-default" id="btn-slider" type="button">
          <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
        </button>
        <div class="brand">
          <a class="navbar-brand me-auto text-danger txt" href="<?= base_url('dashboard'); ?>"><img
              src="<?= base_url('assets/image/admin/logo/' . $sekolah['logo']); ?>" alt=""></a>
          <p class="nama_sekolah"><?= $sekolah['nama_sekolah']; ?></p>
        </div>
        <ul class="nav ms-auto">
          <li class="nav-item dropstart">
            <a class="nav-link text-dark ps-3 pe-1" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown">
              <img src="<?= base_url('assets/image/walikelas/' . $users['foto']); ?>" alt="user" class="img-user">
            </a>
            <div class="dropdown-menu mt-2 pt-0" aria-labelledby="navbarDropdown">
              <div class="d-flex p-3 border-bottom mb-2">
                <img src="<?= base_url('assets/image/walikelas/' . $users['foto']); ?>" alt="user"
                  class="img-user me-2">
                <div class="d-block">
                  <p class="fw-bold m-0 lh-1"><?= $users['nama']; ?></p>
                  <small><?= $users['email']; ?></small>
                </div>
              </div>
              <a class="dropdown-item" href="<?= base_url('guru/dashboard/profile/' . $users['id']); ?>">
                <i class="fa fa-user fa-lg me-3" aria-hidden="true"></i>Profile
              </a>
              <a class="dropdown-item" href="<?= base_url('login/logout'); ?>">
                <i class="fa fa-sign-out fa-lg me-2" aria-hidden="true"></i>LogOut
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="slider" id="sliders">
      <div class="slider-head">
        <div class="d-block pt-4 pb-3 px-3">
          <img src="<?= base_url('assets/image/walikelas/' . $users['foto']); ?>" alt="user"
            class="slider-img-user mb-2">
          <p class="fw-bold mb-0 lh-1 text-white"><?= $users['nama']; ?></p>
          <small class="text-white"><?= $users['email']; ?></small>
        </div>
      </div>
      <div class="slider-body px-1">
        <nav class="nav flex-column">
          <?php if ($users['level'] == 'Wali Kelas') : ?>
          <ul>
            <li>
              <a class="nav-link px-3 active" href="<?= base_url('guru/nilai'); ?>">
                <i class="fa fa-folder fa-lg box-icon" aria-hidden="true"></i>Input Nilai
              </a>
            </li>
            <li>
              <a class="nav-link px-3 active" href="<?= base_url('guru/rapot'); ?>">
                <i class="fa fa-print fa-lg box-icon" aria-hidden="true"></i>Cetak Rapot
              </a>
            </li>
            <hr class="soft my-1 bg-white" />
            <li>
              <a class="nav-link px-3" href="<?= base_url('login/logout'); ?>">
                <i class="fa fa-sign-out fa-lg box-icon" aria-hidden="true"></i>LogOut
              </a>
            </li>
          </ul>
          <?php endif; ?>

        </nav>
      </div>
    </div>

    <?= $this->renderSection("body") ?>

  </div>
  <div class="slider-background" id="sliders-background"></div>
  <script src="<?= base_url('assets/dist/js/jquery.js'); ?>"></script>
  <script src="<?= base_url('assets/assets/app/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/dist/js/index.js'); ?>"></script>
  <script src="<?= base_url('assets/assets/DataTables/js/jquery.dataTables.min.js'); ?>"></script>
  <script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
  </script>

</body>

</html>