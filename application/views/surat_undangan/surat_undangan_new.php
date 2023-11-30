<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Undangan</a></li>
		<li class="active">Tambah</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Tambah Surat Undangan Baru</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">OPD Tujuan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="opdTujuan" name="opdTujuan[]" class="form-control" style="width: 100%" data-placeholder="OPD Tujuan" multiple required>
								<option value="">&nbsp;</option>
								<?php foreach ($list_opd as $opd) : ?>
									<option value="<?= $opd->id ?>"><?= $opd->nama_opd ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Asisten Koordinasi <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="asisten_koor" name="asisten_koor" class="form-control" style="width: 100%" data-placeholder="Asisten Koordinasi" required>
								<option value="">&nbsp;</option>
								<?php foreach ($list_asisten as $asisten) : ?>
									<option value="<?= $asisten->id_user ?>"><?= $asisten->nama_jabatan ?> (<?= $asisten->nama_user ?>)</option>
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
								<input type="text" name="tanggal_surat" class="form-control" placeholder="yyyy-mm-dd" id="tanggal_surat" required>
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
						<label class="col-sm-3 control-label">Isi Pendahuluan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="isi_pendahuluan" rows="5" class="form-control" placeholder="Isi pendahuluan" required></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi Penutup <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="isi_penutup" rows="5" class="form-control" placeholder="Isi penutup" required></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Hari/Tanggal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="hari_tanggal" class="form-control" placeholder="Hari/Tanggal" required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Waktu <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="waktu_kegiatan" class="form-control" placeholder="Waktu" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tempat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="lokasi_kegiatan" class="form-control" placeholder="Tempat" required />
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
							<!-- <button class="btn btn-info btn-quirk btn-stroke mr5">Simpan draft</button> -->
							<button class="btn btn-info btn-quirk mr5">Simpan draft</button>
							<button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
							<a href="/surat_undangan" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>