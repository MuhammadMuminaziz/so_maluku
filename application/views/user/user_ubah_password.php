<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li class="active">Ubah Profil</li>
	</ol>

	<div class="col-md-6">
		<?php if ($this->session->flashdata('message_success')) : ?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= $this->session->flashdata('message_success') ?>
			</div>
		<?php endif ?>
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Ubah Profil</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">Password Lama <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="password" name="old_password" class="form-control" placeholder="Password Lama" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Password Baru <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="password" name="password" class="form-control" placeholder="Password Baru" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="password" name="password2" class="form-control" placeholder="Konfirmasi Password Baru" required />
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-info btn-quirk mr5" name="draft">Simpan</button>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
