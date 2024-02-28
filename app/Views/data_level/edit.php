<div id="main-content">
	<div class="page-heading">
		<div class="page-title">
			<div class="row">
				<div class="col-12 col-md-6 order-md-1 order-last">
					<h3>Edit <?=$title?></h3>
					<p class="text-subtitle text-muted">
						Silakan Edit <?=$title?>
					</p>
				</div>
				<div class="col-12 col-md-6 order-md-2 order-first">
					<nav
					aria-label="breadcrumb"
					class="breadcrumb-header float-start float-lg-end"
					>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?=base_url('login/dashboard')?>">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Edit <?=$title?>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<section class="section">
		<div class="card">
			<form action="<?= base_url('data_level/aksi_edit/')?>" method="post" class="row g-3" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $jojo->id_level ?>">

				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="mb-3">
								<label for="username" class="form-label">Level</label>
								<input type="text" class="form-control" id="level" placeholder="Masukkan Level" name="level" value="<?php echo $jojo->nama_level ?>" required>
							</div>
						</div>

						<!-- bagian tombol submit -->
						<div class="col-12">
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-0 col-md-offset-0">
									<a href="javascript:history.back()" class="btn btn-danger">Cancel</a>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
						<!-- bagian tombol submit -->
					</form>
				</div>
			</body>
			</html>