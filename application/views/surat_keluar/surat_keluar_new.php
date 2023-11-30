<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Keluar</a></li>
		<li class="active">Tambah</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Tambah Surat Keluar Baru</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nomor" class="form-control" placeholder="Nomor surat" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Judul <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nomor" class="form-control" placeholder="Judul surat" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Lampiran <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="lampiran" class="form-control" placeholder="Lampiran" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Hal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="hal" class="form-control" placeholder="Hal" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tempat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="tempat" class="form-control" placeholder="Tempat" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<!-- <input type="text" name="tempat" class="form-control" placeholder="Type your email..." required /> -->
							<div class="input-group">
								<input type="text" name="tanggal" class="form-control" placeholder="yyyy-mm-dd" id="datepicker">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="isi" rows="5" class="form-control" placeholder="Isi surat" required></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tembusan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="manfaat" rows="5" class="form-control" placeholder="Tembusan" required></textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<!-- <button class="btn btn-info btn-quirk btn-stroke mr5">Simpan draft</button> -->
							<button class="btn btn-info btn-quirk mr5">Simpan</button>
							<button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
							<a href="/surat_keluar" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
