<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?=$title?></h3>
                    <p class="text-subtitle text-muted">Anda dapat mengedit <?=$title?> di bawah</p>
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

<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div>
      <div class="row">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"><?=$subtitle?></h4>
                  <small class="text-danger text-sm">* Biarkan Jika Tidak Diedit</small>
               </div>
            </div>
            <div class="card-body">
               <div class="new-user-info">
                  <form action="<?= base_url('pelanggan/aksi_edit')?>" method="post" enctype="multipart/form-data">
                     <div class="row">

                        <input type="hidden" name="id" value="<?php echo $jojo->PelangganID ?>">

                        <div class="form-group">
                           <label class="form-label" for="fname">Nama Pelanggan <small class="text-danger text-sm">*</small></label>
                           <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan Nama Pelanggan" value="<?= $jojo->NamaPelanggan?>" required>
                        </div>

                        <div class="form-group col-md-12 mt-2">
                          <label class="form-label" for="fname">Alamat <small class="text-danger text-sm">*</small></label>
                          <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat"><?= $jojo->Alamat?></textarea>
                       </div>

                       <div class="form-group">
                        <label class="form-label" for="fname">No. Telepon <small class="text-danger text-sm">*</small></label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan No. Telepon (Max 15 Digit)" value="<?= $jojo->NomorTelepon?>" required>
                     </div>

                  </div>
                  <a href="javascript:history.back()" class="btn btn-danger mt-4">Cancel</a>
                  <button type="submit" class="btn btn-primary mt-4">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>