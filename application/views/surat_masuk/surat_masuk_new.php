<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Masuk</a></li>
		<li class="active">Tambah</li>
	</ol>

	<div class="col-md-8">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Tambah Surat Masuk Baru</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-3 control-label">Tujuan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="hidden" name="id_penerima" value="<?= $id_user_penerima ?>" />
							<select id="id_penerima" name="id_penerima" class="form-control" style="width: 100%" data-placeholder="Tujuan" <?= $is_internal_opd ? 'disabled' : '' ?>> required>
								<option value="">&nbsp;</option>
								<?php foreach ($list_penerima as $penerima) : ?>
									<option value="<?= $penerima->id ?>" <?= $is_internal_opd ? 'selected' : '' ?>><?= $penerima->nama_jabatan ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nomor_surat" class="form-control" placeholder="Nomor Surat" required>
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
						<label class="col-sm-3 control-label">Perihal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="perihal" class="form-control" placeholder="Perihal" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Pengirim <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="pengirim" class="form-control" placeholder="Pengirim" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Dokumen <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="file" name="file_surat" class="form-control" required />
							<?php if (isset($errors)) : ?>
								<small class="text-danger"><?= $errors; ?></small>
							<?php else : ?>
								<small>pastikan file berbentuk pdf dan max 5 mb</small>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Ringkasan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea id="ringkasan" name="ringkasan" rows="20" class="form-control" placeholder="Ringkasan"></textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-info btn-quirk mr5">Simpan draft</button>
							<button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
							<a href="/surat_masuk_luar_opd" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>