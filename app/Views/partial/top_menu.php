<?php
$db         = \Config\Database::connect();

$level      = session()->get('level');
$on         = 'user.level=level.id_level';
$namalevel  = $db->table('user')->join('level', $on, 'left')->where('level.id_level', $level)->get()->getRow();

$id_user = session()->get('id');
$user = $db->table('user')->where('id_user', $id_user)->get()->getRow();


if (!empty($user->foto)) {
  $foto = base_url('images/' . $user->foto);
} else {
  $foto = base_url('images/default.png');
}

?>

<div id="main" class="layout-navbar navbar-fixed">
  <header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
      <div class="container-fluid">
        <a class="burger-btn d-block"><i class="bi bi-justify fs-3"></i></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-lg-0">

            <div class="dropdown">
              <a data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-menu d-flex">
                  <div class="user-name text-end me-3">
                    <?php
                    $level = session()->get('level');

                    if ($level == 1 || $level == 2 || $level == 3) {
                    // Jika level 1, 2, atau 3, gunakan session()->get('username')
                      echo "<h6 class='mb-0 text-gray-600'>" . session()->get('username') . "</h6>";
                    }  else {
                    // Jika level tidak sesuai dengan kriteria di atas
                      echo "<h6 class='mb-0 text-gray-600'>Teks Default</h6>";
                    }
                    ?>
                    <p class="mb-0 text-sm text-gray-600"><?=$namalevel->nama_level?></p>
                  </div>
                  <div class="user-img d-flex align-items-center">
                    <div class="avatar avatar-md">
                      <img src="<?=base_url('images/default.png')?>">
                    </div>
                  </div>
                </div>
              </a>
              <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="dropdownMenuButton"
              style="min-width: 11rem"
              >
              <li>
                <h6 class="dropdown-header">
                  <?php
                  $level = session()->get('level');

                  if ($level == 1 || $level == 2 || $level == 3) {
                    // Jika level 1, 2, atau 3, gunakan session()->get('username')
                    echo "Halo, " . session()->get('username') . "!";
                  }  else {
                    // Jika level tidak sesuai dengan kriteria di atas
                    echo "Selamat Datang!";
                  }
                  ?>
                </h6>
              </li>

             

              <li>
                <a class="dropdown-item" href="<?=base_url('/Login/log_out')?>">
                  <i class="fa-regular fa-arrow-right-from-bracket me-2"></i>
                Log-out</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>