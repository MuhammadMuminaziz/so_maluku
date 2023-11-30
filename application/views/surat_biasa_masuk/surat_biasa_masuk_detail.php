<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Biasa</a></li>
		<li class="active">Detail</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Detail Surat Biasa</h4>
			</div>
			<div class="panel-body">
				<hr>
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor Surat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_biasa->nomor_surat ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal Surat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_biasa->tanggal_surat ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Lampiran</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_biasa->lampiran ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Perihal</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_biasa->perihal ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi Surat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left" style="text-align: left;"><?php echo $surat_biasa->isi_surat ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tembusan</label>
						<div class="col-sm-8">
							<div class="control-label pull-left" style="text-align: left;"><?php echo $surat_biasa->list_tembusan ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Dokumen</label>
						<div class="col-sm-8">
							<div class="control-label pull-left" style="text-align: left;"><a target="_blank" href="/generated/surat_biasa/<?php echo $surat_biasa->doc ?>">Download</i></a></div>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<a href="/surat_biasa_masuk" class="btn btn-quirk btn-wide btn-default mr5">Kembali</a>
							<?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM) : ?>
								<form action="/surat_biasa/approve_biro" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $surat_biasa->id ?>" />
									<button class="btn btn-success btn-quirk btn-wide mr5" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Teruskan</button>
								</form>
							<?php elseif ($current_user->level_jabatan == LEVEL_SEKDA || $current_user->level_jabatan == LEVEL_SEKRE_SEKDA) : ?>
								<form action="/surat_biasa/approve_sekda" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $surat_biasa->id ?>" />
									<button class="btn btn-success btn-quirk btn-wide mr5" name="approve" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Terima</button>
								</form>
							<?php endif ?>
						</div>
					</div>

				</div>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
