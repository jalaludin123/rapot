<?= $this->extend("template/layout-login") ?>
<?= $this->section("body") ?>
<div class="form-signin bg-light">
  <form action="<?= base_url('login/cek_login'); ?>" method="POST">
    <?= csrf_field(); ?>
    <img class="mb-4" src="<?= base_url('assets/image/admin/logo/' . $sekolah['logo']); ?>" alt="" width="72">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <?php
    if (session()->getFlashData('error')) {
      echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                    <strong>';
      echo session()->getFlashdata('error');
      echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (session()->getFlashData('success')) {
      echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                    <strong>';
      echo session()->getFlashdata('success');
      echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (session()->getFlashData('hapus')) {
      echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                    <strong>';
      echo session()->getFlashdata('hapus');
      echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (session()->getFlashData('edit')) {
      echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                    <strong>';
      echo session()->getFlashdata('edit');
      echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (session()->getFlashData('logout')) {
      echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                    <strong>';
      echo session()->getFlashdata('logout');
      echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if (session()->getFlashData('gagal')) {
      echo '<div class="alert alert-warning alert-dismissible fade show auto-close" role="alert">
                            <strong>';
      echo session()->getFlashdata('gagal');
      echo '</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    ?>
    <div class="form-floating">
      <?php
      $validasi = (session()->getFlashdata('errEmail')) ? 'is-invalid' : '';
      ?>
      <input type="email" class="form-control <?= $validasi ?>" name="email" id="floatingInput"
        placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
      <?php
      if (session()->getFlashdata('errEmail')) {
        echo '  <div id="validationServer03Feedback" class="invalid-feedback">
                        ' . session()->getFlashdata('errEmail') . '
                        </div>';
      }
      ?>
    </div>
    <div class="form-floating">
      <?php
      $validasi = (session()->getFlashdata('errPass')) ? 'is-invalid' : '';
      ?>
      <input type="password" name="password" class="form-control <?= $validasi ?>" id="floatingPassword"
        placeholder="Password">
      <label for="floatingPassword">Password</label>
      <?php
      if (session()->getFlashdata('errPass')) {
        echo '  <div id="validationServer03Feedback" class="invalid-feedback">
                        ' . session()->getFlashdata('errPass') . '
                        </div>';
      }
      ?>
    </div>
    <button class="w-100 btn btn-lg btn-dark mt-4" type="submit">Sign in</button>
  </form>
</div>
<?= $this->endSection() ?>