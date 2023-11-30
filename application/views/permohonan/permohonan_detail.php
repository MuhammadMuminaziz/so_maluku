<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Permohonan</a></li>
		<li class="active">Detail</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Detail Surat Permohonan</h4>
				<!-- <p><?php echo $id ?></p> -->
			</div>
			<div class="panel-body">
				<hr>
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">OPD</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->nama_opd ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->nomor_surat ?></div>
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
						<label class="col-sm-3 control-label">Dari</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->dari ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Ke</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $permohonan->ke ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?= $permohonan->tanggal_berangkat ?> - <?= $permohonan->tanggal_pulang ?></div>
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
							<a href="/permohonan" class="btn btn-quirk btn-wide btn-default mr5">Kembali</a>
							<!-- <?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM) : ?>
								<form action="/permohonan/approve_biro" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $permohonan->id ?>" />
									<button class="btn btn-success btn-quirk btn-wide mr5">Teruskan</button>
								</form>
							<?php elseif ($current_user->level_jabatan == LEVEL_SEKDA || $current_user->level_jabatan == LEVEL_SEKRE_SEKDA) : ?>
								<form action="/permohonan/approve_sekda" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $permohonan->id ?>" />
									<button class="btn btn-success btn-quirk btn-wide mr5" name="approve">Terima</button>
									<button class="btn btn-danger btn-quirk mr5" name="reject">Tolak</button>
								</form>
							<?php endif ?> -->

							<?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM && $permohonan->status != BIASA_APPROVED) : ?>
								<hr />
								<form action="/permohonan/number_surat" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $permohonan->id ?>" />
									<div class="form-group" style="margin-bottom: 10px;">
										<label class="col-sm-5 control-label" style="text-align: left;">Nomor Surat <span class="text-danger">*</span></label>
										<div class="col-sm-7">
											<input type="text" name="nomor_surat_biro" class="form-control" placeholder="Nomor surat" required />
										</div>
									</div>
									<button class="btn btn-success btn-quirk btn-wide mr5" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Simpan Nomor Surat</button>
								</form>
							<?php elseif ($current_user->level_jabatan == LEVEL_TU && $permohonan->status == BIASA_WAITING_NUMBER_TU) : ?>
								<hr />
								<form action="/permohonan/number_surat" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $permohonan->id ?>" />
									<div class="form-group" style="margin-bottom: 10px;">
										<label class="col-sm-5 control-label" style="text-align: left;">Nomor Surat (TU) <span class="text-danger">*</span></label>
										<div class="col-sm-7">
											<input type="text" name="nomor_surat" class="form-control" placeholder="Nomor surat" required />
										</div>
									</div>
									<button class="btn btn-success btn-quirk btn-wide mr5" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Simpan Nomor Surat</button>
								</form>
							<?php elseif (!in_array($permohonan->status, array(PERMOHONAN_DRAFT, BIASA_APPROVED)) && $current_user->level_jabatan != LEVEL_KASUBAG_KASIE) : ?>
								<form action="/permohonan/approve_surat" method="POST" style="display: inline-block">
									<input type="hidden" name="id" value="<?php echo $permohonan->id ?>" />
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
												<form action="/permohonan/reject_surat" method="POST">
													<input type="hidden" name="id" value="<?php echo $permohonan->id ?>" />
													<textarea id="revisi" name="revisi" rows="5" class="form-control" placeholder="Catatan revisi"><?= $permohonan->revisi ?></textarea>
													<br />
													<button class="btn btn-danger btn-quirk mr5" name="reject">Simpan Revisi</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							<?php endif ?>
						</div>
					</div>

				</div>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>