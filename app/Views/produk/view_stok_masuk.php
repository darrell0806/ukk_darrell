<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?=$title?></h3>
                    <p class="text-subtitle text-muted">Anda dapat melihat <?=$title?> di bawah</p>
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
   <div class="row">
      <div class="col-sm-12">
         <div class="card">

            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <a href="<?= base_url('produk/add_stok_masuk/' . $jojo2)?>" class="btn btn-primary my-1"><i class="faj-button fa-regular fa-plus" style="color: #ffffff;"></i>Tambah</a>
               </div>
            </div>

            <div class="card-body">
               <div class="table-responsive">
                  <table id="table1" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Nama Produk</th>
                           <th>Stok Produk Masuk</th>
                           <th>Tanggal Masuk</th>
                           <th>Waktu Masuk</th>
                           <th>User</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        $no=1;
                        foreach ($jojo as $riz) {
                         ?>
                         <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $riz->NamaProduk ?></td>
                          <td><?= $riz->Stok_masuk ?></td>
                          <td><?= date('d M Y', strtotime($riz->created_at_produk_masuk)) ?></td>
                          <td><?= date('H:i:s', strtotime($riz->created_at_produk_masuk)) ?></td>
                          <td><?= $riz->username ?></td>

                          <td>

                           <a href="<?php echo base_url('produk/delete_stok_masuk/'. $riz->ProdukMasukID)?>" class="btn btn-danger my-1"><i class="fa-regular fa-minus" style="color: #ffffff;"></i></a>
                        </td>
                     </tr>
                  <?php } ?>
               </tbody>
              <!--  <tfoot>
                  <tr>
                     <th>No.</th>
                     <th>Foto</th>
                     <th>Username</th>
                     <th>Level</th>
                     <th style="min-width: 100px">Action</th>
                  </tr>
               </tfoot> -->

            </table>
         </div>
      </div>
   </div>
</div>
</div>
</div>

<!-- <script>
   $(document).ready(function() {
      $('#table2').DataTable({
      });
   });
</script> -->