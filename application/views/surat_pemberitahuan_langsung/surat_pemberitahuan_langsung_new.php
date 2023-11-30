<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Biasa OPD</a></li>
		<li class="active">Tambah</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Tambah Surat Biasa OPD Baru</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">OPD Tujuan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="opdTujuan" name="opdTujuan[]" class="form-control" style="width: 100%" data-placeholder="OPD Tujuan" multiple>
								<option value="">&nbsp;</option>
								<?php foreach ($list_opd as $opd) : ?>
									<option value="<?= $opd->id ?>"><?= $opd->nama_opd ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nomor_surat" class="form-control" placeholder="Nomor surat" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" name="tanggal_surat" class="form-control" placeholder="yyyy-mm-dd" id="tanggal_surat">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Lampiran <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="lampiran" class="form-control" placeholder="Lampiran" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Perihal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="perihal" class="form-control" placeholder="Perihal" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="isi_surat" rows="5" class="form-control" placeholder="Isi surat" required></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tembusan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="list_tembusan" rows="5" class="form-control" placeholder="Tembusan" required></textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-info btn-quirk mr5">Simpan draft</button>
							<button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
							<a href="/surat_pemberitahuan_langsung" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>