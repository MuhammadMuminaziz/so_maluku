<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Biasa</a></li>
		<li class="active">Ubah</li>
	</ol>

	<div class="col-md-8">
		<?php if ($this->session->flashdata('message_success')) : ?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= $this->session->flashdata('message_success') ?>
			</div>
		<?php endif ?>
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Ubah Surat Biasa</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
						<div class="col-sm-8 control-label" style="text-align: left;">
							<span class="label label-info">
								<?php echo $surat_masuk->status ?>
							</span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tujuan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<?php if ($is_internal_opd) : ?>
								<input type="hidden" name="id_penerima" value="<?= $id_user_penerima ?>" />
							<?php endif ?>
							<select id="id_penerima" name="id_penerima" class="form-control" style="width: 100%" data-placeholder="Tujuan" <?= $is_internal_opd ? 'disabled' : '' ?>> required>
								<option value="">&nbsp;</option>
								<?php foreach ($list_penerima as $penerima) : ?>
									<option value="<?= $penerima->id ?>" <?= $surat_masuk->id_penerima === $penerima->id ? 'selected' : '' ?>><?= $penerima->nama_jabatan ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nomor_surat" class="form-control" placeholder="Nomor Surat" required value="<?php echo $surat_masuk->nomor_surat ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" name="tanggal_surat" class="form-control" placeholder="yyyy-mm-dd" id="tanggal_surat" value="<?php echo $surat_masuk->tanggal_surat ?>">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Perihal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="perihal" class="form-control" placeholder="Perihal" required value="<?php echo $surat_masuk->perihal ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Pengirim <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="pengirim" class="form-control" placeholder="Pengirim" required value="<?php echo $surat_masuk->pengirim ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Dokumen <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<a target="_blank" href="/uploaded/<?= $surat_masuk->doc ?>.pdf">Download</a>
							<input type="file" id="file_surat" name="file_surat" class="form-control" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Ringkasan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea id="ringkasan" name="ringkasan" rows="20" class="form-control" placeholder="Ringkasan" required><?php echo $surat_masuk->ringkasan ?></textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<?php if ($surat_masuk->status === MASUK_DRAFT) : ?>
								<button class="btn btn-info btn-quirk btn-stroke mr5" name="draft">Simpan draft</button>
								<button class="btn btn-success btn-quirk btn-wide mr5" name="kirim" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Kirim</button>
							<?php endif ?>
							<a href="/<?= $kembali; ?>" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>