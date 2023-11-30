<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Permohonan</a></li>
		<li class="active">Ubah</li>
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
				<h4 class="panel-title">Ubah Surat Permohonan</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<span class="label label-info">
								<?php echo $permohonan->status ?>
							</span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Lampiran <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="lampiran" class="form-control" placeholder="Lampiran" required value="<?php echo $permohonan->lampiran ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Hal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="hal" class="form-control" placeholder="Hal" required value="<?php echo $permohonan->hal ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="isi" rows="5" class="form-control" placeholder="Isi surat" required><?php echo $permohonan->isi ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Manfaat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="manfaat" rows="5" class="form-control" placeholder="Manfaat" required><?php echo $permohonan->manfaat ?></textarea>
						</div>
					</div>

					<div class="panel-group" id="accordion2">
						<div class="panel panel-default">
							<div class="panel-heading" id="sppd_heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" aria-expanded="true" data-parent="#accordion2" href="#collapseOne2">
										Detail SPPD
									</a>
								</h4>
							</div>
							<div id="collapseOne2" class="panel-collapse" aria-labelledby="sppd_heading">
								<div class="panel-body">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-sm-3 control-label">Dari <span class="text-danger">*</span></label>
											<div class="col-sm-8">
												<input type="text" name="dari" class="form-control" placeholder="Dari" required value="<?php echo $permohonan->dari ?>" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Ke <span class="text-danger">*</span></label>
											<div class="col-sm-8">
												<input type="text" name="ke" class="form-control" placeholder="Ke" required value="<?php echo $permohonan->ke ?>" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Tgl Berangkat <span class="text-danger">*</span></label>
											<div class="col-sm-8">
												<div class="input-group">
													<input type="text" name="tanggal_berangkat" class="form-control" placeholder="yyyy-mm-dd" id="tanggal_berangkat" value="<?php echo $permohonan->tanggal_berangkat ?>" required>
													<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Tgl. Pulang <span class="text-danger">*</span></label>
											<div class="col-sm-8">
												<div class="input-group">
													<input type="text" name="tanggal_pulang" class="form-control" placeholder="yyyy-mm-dd" id="tanggal_pulang" value="<?php echo $permohonan->tanggal_pulang ?>" required>
													<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Maksud <span class="text-danger">*</span></label>
											<div class="col-sm-8">
												<textarea name="maksud" rows="5" class="form-control" placeholder="Maksud" required><?php echo $permohonan->maksud ?></textarea>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Pengikut</label>
											<div class="col-sm-8">
												<textarea name="pengikut" rows="5" class="form-control" placeholder="Pengikut"><?php echo $permohonan->pengikut ?></textarea>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Keterangan</label>
											<div class="col-sm-8">
												<textarea name="keterangan" rows="5" class="form-control" placeholder="Keterangan"><?php echo $permohonan->keterangan ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<?php if ($permohonan->status === PERMOHONAN_DRAFT) : ?>
								<button class="btn btn-info btn-quirk btn-stroke mr5" name="draft">Simpan draft</button>
								<button class="btn btn-success btn-quirk btn-wide mr5" name="kirim" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Kirim</button>
							<?php endif ?>
							<a href="/permohonan" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
