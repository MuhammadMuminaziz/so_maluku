<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li class="active">SPT</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Surat Perintah Tugas (SPT)</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<div class="panel-group" id="accordion2">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" class="collapsed" data-parent="#accordion2" href="#collapseOne2">
									Detail Surat Permohonan
								</a>
							</h4>
						</div>
						<div id="collapseOne2" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-sm-3 control-label">Nomor TU</label>
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<br />
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<!-- <textarea id="mytextarea" name="tiny">Hello, World!</textarea> -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor SPT <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nomor_spt" class="form-control" placeholder="Nomor SPT" required value="<?php echo isset($spt) ? $spt->nomor_spt : '' ?>" />
						</div>
					</div>
					<!-- <label class="control-label text-right">Dasar:</span></label>
					<br />
					<br />
					<textarea id="wysiwyg_dasar" placeholder="Dasar..." class="form-control" rows="20" name="dasar"><?php echo isset($spt) ? $spt->dasar : '' ?></textarea>
					<br />
					<br />
					<label class="control-label text-right">Nama Yang Ditugaskan:</span></label>
					<br />
					<br />
					<textarea id="wysiwyg_pelaksana" placeholder="Nama yang ditugaskan..." class="form-control" rows="20" name="pelaksana"><?php echo isset($spt) ? $spt->pelaksana : '' ?></textarea>
					<br />
					<br /> -->
					<label class="control-label text-right">Untuk:</span></label>
					<br />
					<br />
					<textarea id="wysiwyg_untuk" placeholder="Untuk..." class="form-control" rows="20" name="untuk"><?php echo isset($spt) ? $spt->untuk : '' ?></textarea>
					<br />
					<br />
					<!-- <label class="control-label text-right">Tembusan:</span></label>
					<br />
					<br />
					<textarea id="wysiwyg_tembusan" placeholder="Tembusan..." class="form-control" rows="10" name="tembusan"><?php echo isset($spt) ? $spt->tembusan : '' ?></textarea>
					<br />
					<br /> -->
					<!-- <br />
					<br />
					<label class="control-label text-right">Tembusan</span></label>
					<br />
					<br />
					<textarea id="wysiwyg2" placeholder="Masukkan tembusan di sini..." class="form-control" rows="10" name="tembusan" required><?php echo isset($spt) ? $spt->tembusan : '' ?></textarea> -->

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-info btn-quirk btn-stroke mr5" name="draft">Simpan draft</button>
							<button class="btn btn-success btn-quirk mr5" name="final" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Kirim (Final)</button>
							<a href="/permohonan" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>