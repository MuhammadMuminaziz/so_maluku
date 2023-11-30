<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Undangan</a></li>
		<li class="active">Detail</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Detail Surat Undangan</h4>
				<!-- <p><?php echo $id ?></p> -->
			</div>
			<div class="panel-body">
				<hr>
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor Surat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->nomor_surat ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal Surat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->tanggal_surat ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Lampiran</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->lampiran ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Perihal</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->perihal ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi Pendahuluan</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->isi_pendahuluan ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi Penutup</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->isi_penutup ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Hari/Tanggal</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->hari_tanggal ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Waktu</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->waktu_kegiatan ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tempat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->lokasi_kegiatan ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tembusan</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_undangan->list_tembusan ?></div>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<a href="/surat_undangan_masuk" class="btn btn-quirk btn-wide btn-default mr5">Kembali</a>
							<?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM) : ?>
								<form action="/surat_undangan/approve_biro" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $surat_undangan->id ?>" />
									<button class="btn btn-success btn-quirk btn-wide mr5" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);>Teruskan</button>
								</form>
							<?php elseif ($current_user->level_jabatan == LEVEL_SEKDA || $current_user->level_jabatan == LEVEL_SEKRE_SEKDA) : ?>
								<form action="/surat_undangan/approve_sekda" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $surat_undangan->id ?>" />
									<button class="btn btn-success btn-quirk btn-wide mr5" name="approve" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);>Terima</button>
									<!-- <button class="btn btn-danger btn-quirk mr5" name="reject">Tolak</button> -->
								</form>
							<?php endif ?>
						</div>
					</div>

				</div>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
