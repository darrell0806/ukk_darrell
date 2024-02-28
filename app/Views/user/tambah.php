<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?=$title?></h3>
                    <p class="text-subtitle text-muted">Anda dapat menambah <?=$title?> di bawah</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=base_url('login/dashboard')?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="form-horizontal form-label-left" novalidate action="<?= base_url('User/aksi_tambah')?>" method="post" enctype="multipart/form-data">
<div class="col-md-6 col-12">
                <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Tambah User</h4>
                    <a href="<?= site_url('/user') ?>" class="btn btn-light-secondary me-1 mb-1">Back</a>
                </div>
                    
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                    <div class="col-md-4">
                                            <label>Foto</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="position-relative">
                                                <input type="file" class="form-control" placeholder="Foto" name="foto" id="foto" onchange="previewImage()" required>
                                                    <img id="preview" src="" alt="" style="max-width: 100px; margin-top: 10px;">
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-4">
                                            <label>Username</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" placeholder="Username" name="username"
                                                        id="first-name-icon" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-4">
                                            <label>Password</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                                        id="first-name-icon" required>
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-key"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Level</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                <fieldset class="form-group">
                                        <select class="form-select" id="basicSelect" name="level">
                                        <option>-PILIH-</option>
                                        <?php
                                        foreach ($a as $b) {
                                            ?>
                                            <option value ="<?= $b->id_level?>"><?php echo $b->nama_level?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    </fieldset>
                                        </div>
                                        </div>
                                       
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
function previewImage() {
  var preview = document.querySelector('#preview');
  var file = document.querySelector('#foto').files[0];
  var reader = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}
</script>