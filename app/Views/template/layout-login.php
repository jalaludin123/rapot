<!doctype html>
<html lang="en">

<head>
  <title><?= $title; ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/assets/app/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/index.css'); ?>">
</head>

<body class="text-center login">

  <?= $this->renderSection("body") ?>

  <!-- Bootstrap JS -->
  <script src="<?= base_url('assets/dist/js/jquery.js'); ?>"></script>
  <script src="<?= base_url('assets/dist/js/index.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
  </script>
</body>

</html>