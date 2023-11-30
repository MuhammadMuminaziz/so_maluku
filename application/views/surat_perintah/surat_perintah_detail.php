<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Masuk</a></li>
		<li class="active">Detail</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Detail Surat Masuk</h4>
				<!-- <p><?php echo $id ?></p> -->
			</div>
			<div class="panel-body">
				<hr>
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->nomor ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Lampiran</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->lampiran ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Hal</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->hal ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tempat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->tempat ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->tanggal ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->isi ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Manfaat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->manfaat ?></div>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<a href="/surat_perintah" class="btn btn-quirk btn-wide btn-default mr5">Kembali</a>
							<?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM) : ?>
								<form action="/permohonan/approve_biro" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $permohonan->id ?>" />
									<button class="btn btn-success btn-quirk btn-wide mr5" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);>Teruskan</button>
								</form>
							<?php elseif ($current_user->level_jabatan == LEVEL_SEKDA || $current_user->level_jabatan == LEVEL_SEKRE_SEKDA) : ?>
								<form action="/permohonan/approve_sekda" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $permohonan->id ?>" />
									<button class="btn btn-success btn-quirk btn-wide mr5" name="approve" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);>Terima</button>
									<button class="btn btn-danger btn-quirk mr5" name="reject">Tolak</button>
								</form>
							<?php endif ?>
						</div>
					</div>

				</div>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
