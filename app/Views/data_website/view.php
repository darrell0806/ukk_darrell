<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3><?=$title?></h3>
					<p class="text-subtitle text-muted">Anda dapat melihat data  <?=$title?> di bawah</p>
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

		<section class="section">
			<div class="card">
				<?php if ($jumlah_data == 0) { ?>
					<div class="card-header">
						<a href="<?php echo base_url('data_website/create/') ?>"><button class="btn btn-primary mt-2"><i class="fa-solid fa-plus"></i> Tambah</button></a>
					</div>
				<?php } ?>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped" id="table1">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Website</th>
									<th>Logo Website</th>
									<th>Logo PDF</th>
									<th>Logo Favicon</th>
									<th>Action</th>
								</tr>
							</thead>
							<?php
							$no=1;
							foreach ($jojo as $riz) {
								?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?php echo $riz->nama_website ?></td>
									<td style="width: 100px; height: 100px; overflow: hidden; border-radius: 5px;">
										<img src="<?php echo base_url('logo/logo_website/' . $riz->logo_website) ?>" style="width: 100%; height: 100%; object-fit: contain;">
									</td>
									<td style="width: 75px; height: 75px; overflow: hidden; border-radius: 5px;">
										<img src="<?php echo base_url('logo/logo_pdf/' . $riz->logo_pdf) ?>" style="width: 100%; height: 100%; object-fit: contain;">
									</td>
									<td style="width: 50px; height: 50px; overflow: hidden; border-radius: 5px;">
										<img src="<?php echo base_url('logo/favicon/' . $riz->favicon_website) ?>" style="width: 100%; height: 100%; object-fit: contain;">
									</td>
									<td>
										<a href="<?php echo base_url('data_website/edit/'. $riz->id_website)?>" class="btn btn-warning my-1"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
										<a href="<?php echo base_url('data_website/delete/'. $riz->id_website)?>" class="btn btn-danger my-1"><i class="fa-solid fa-trash"></i></a>
									</td>
								<?php	}
								?>
							</td>
						</body>
					</tr>
				</table>
			</div>
		</div>
	</div>