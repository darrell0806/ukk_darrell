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

           

            <div class="card-body">
               <div class="table-responsive">
                  <table id="table1" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Nama Produk</th>
                           <th>Jumlah Produk</th>
                           <th>Subtotal</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        $no=1;
                        foreach ($a as $riz) {
                          ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $riz->NamaProduk ?></td>
                            <td><?= $riz->JumlahProduk ?> buah</td>
                            <td>Rp <?= number_format($riz->Subtotal, 2, ',', '.') ?></td>
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