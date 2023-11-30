<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li class="active">Ubah OPD</li>
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
				<h4 class="panel-title">Ubah OPD</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nama OPD <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nama_opd" class="form-control" placeholder="Nama OPD" required value="<?= $opd->nama_opd ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Alamat Kantor <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="alamat_opd" class="form-control" placeholder="Nama OPD" required value="<?= $opd->alamat_opd ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Alamat Elektronik <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="alamat_elektronik_opd" rows="5" class="form-control" placeholder="Alamat Elektronik" required><?= $opd->alamat_elektronik_opd ?></textarea>
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
