<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Biasa</a></li>
		<li class="active">Tambah</li>
	</ol>

	<div class="col-md-8">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Tambah Surat Biasa Baru</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-3 control-label">OPD Tujuan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="opdTujuan" name="opdTujuan[]" class="form-control" style="width: 100%" data-placeholder="OPD Tujuan" multiple required>
								<option value="">&nbsp;</option>
								<option value="all">Semua</option>
								<?php foreach ($list_opd as $opd) : ?>
									<option value="<?= $opd->id ?>"><?= $opd->nama_opd ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Paraf Koord. Eselon III <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="id_kabag" name="id_kabag" class="form-control" style="width: 100%" data-placeholder="Paraf Koord. Eselon III" required>
								<option value="">&nbsp;</option>
								<?php foreach ($list_kabag as $kabag) : ?>
									<option value="<?= $kabag->id ?>"><?= $kabag->nama_jabatan ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Jenis Approval</label>
						<div class="col-sm-8" style="padding-top: 10px;">
							<div class="input-group">
								<label class="rdiobox rdiobox-primary">
									<input type="radio" name="is_langsung" value="0" checked>
									<span>Sekda</span>
								</label>
								<label class="rdiobox rdiobox-primary">
									<input type="radio" name="is_langsung" value="1">
									<span>Kadis</span>
								</label>
							</div>
						</div>
					</div>

					<div class="form-group" id="id_asisten_wrapper">
						<label class="col-sm-3 control-label">Paraf Koord. Asisten Sekda <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="id_asisten" name="id_asisten" class="form-control" style="width: 100%" data-placeholder="Paraf Koord. Asisten Sekda" required>
								<option value="">&nbsp;</option>
								<?php foreach ($list_asekda as $asekda) : ?>
									<option value="<?= $asekda->id ?>"><?= $asekda->nama_jabatan ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<!-- <div class="form-group">
						<label class="col-sm-3 control-label">Nama Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nama_surat" class="form-control" placeholder="Nama surat" required />
						</div>
					</div> -->

					<!-- <div class="form-group">
						<label class="col-sm-3 control-label">Nomor Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nomor_surat" class="form-control" placeholder="Nomor surat" required />
						</div>
					</div> -->

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
						<label class="col-sm-3 control-label">Perihal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="perihal" class="form-control" placeholder="Perihal" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Lampiran</label>
						<div class="col-sm-8">
							<input type="text" name="lampiran" class="form-control" placeholder="Lampiran" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Upload Lampiran</label>
						<div class="col-sm-8">
							<input type="file" name="file_lampiran" class="form-control" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea id="isi_surat" name="isi_surat" rows="20" class="form-control" placeholder="Isi surat"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tembusan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea id="list_tembusan" name="list_tembusan" rows="5" class="form-control" placeholder="Tembusan" required>
1. Bapak Gubernur Maluku sebagai laporan.<br/>
2. Bapak Wakil Gubernur Maluku sebagai laporan.<br/>
3. Pertinggal.</textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-info btn-quirk mr5">Simpan draft</button>
							<button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
							<a href="/surat_biasa" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
