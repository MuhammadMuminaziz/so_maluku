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
				<!-- <p><?php echo $id ?></p> -->
			</div>
			<div class="panel-body">
				<hr>
				<div class="form-horizontal">
					<?php if (isset($surat_biasa->revisi)) : ?>
						<div class="panel panel-warning">
							<div class="panel-heading">
								<h3 class="panel-title">Catatan Revisi</h3>
							</div>
							<div class="panel-body">
								<p><strong><?php echo $surat_biasa->revisi ?></strong></p>
							</div>
						</div>

					<?php endif ?>

					<div class="form-group">
						<label class="col-sm-3 control-label">Perihal</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_biasa->perihal ?></div>
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

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<a href="/surat_biasa" class="btn btn-quirk btn-wide btn-default mr5">Kembali</a>
							<?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM && $surat_biasa->status != BIASA_APPROVED) : ?>
								<hr />
								<form action="/surat_biasa/number_surat" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $surat_biasa->id ?>" />
									<div class="form-group" style="margin-bottom: 10px;">
										<label class="col-sm-5 control-label" style="text-align: left;">Nomor Surat <span class="text-danger">*</span></label>
										<div class="col-sm-7">
											<input type="text" name="nomor_surat_biro" class="form-control" placeholder="Nomor surat" required />
										</div>
									</div>
									<button class="btn btn-success btn-quirk btn-wide mr5" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Simpan Nomor Surat</button>
								</form>
							<?php elseif ($current_user->level_jabatan == LEVEL_TU && $surat_biasa->status == BIASA_WAITING_NUMBER_TU) : ?>
								<hr />
								<form action="/surat_biasa/number_surat" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $surat_biasa->id ?>" />
									<div class="form-group" style="margin-bottom: 10px;">
										<label class="col-sm-5 control-label" style="text-align: left;">Nomor Surat (TU) <span class="text-danger">*</span></label>
										<div class="col-sm-7">
											<input type="text" name="nomor_surat" class="form-control" placeholder="Nomor surat" required />
										</div>
									</div>
									<button class="btn btn-success btn-quirk btn-wide mr5" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Simpan Nomor Surat</button>
								</form>
							<?php elseif (!in_array($surat_biasa->status, array(BIASA_DRAFT, BIASA_APPROVED)) && $current_user->level_jabatan != LEVEL_KASUBAG_KASIE) : ?>
								<?php if ($level_surat == $current_user->level_jabatan) : ?>
									<form action="/surat_biasa/approve_surat" method="POST" style="display: inline-block">
										<input type="hidden" name="id" value="<?php echo $surat_biasa->id ?>" />
										<button class="btn btn-success btn-quirk btn-wide mr5" name="approve" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Terima</button>
									</form>
									<hr />
									<div class="panel-group" id="accordion2">
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title">
													<a data-toggle="collapse" class="collapsed" data-parent="#accordion2" href="#collapseOne2">
														Revisi Surat
													</a>
												</h4>
											</div>
											<div id="collapseOne2" class="panel-collapse collapse">
												<div class="panel-body">
													<form action="/surat_biasa/reject_surat" method="POST">
														<input type="hidden" name="id" value="<?php echo $surat_biasa->id ?>" />
														<textarea id="revisi" name="revisi" rows="5" class="form-control" placeholder="Catatan revisi"><?= $surat_biasa->revisi ?></textarea>
														<br />
														<button class="btn btn-danger btn-quirk mr5" name="reject">Simpan Revisi</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								<?php endif ?>
							<?php endif ?>
						</div>
					</div>

				</div>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>