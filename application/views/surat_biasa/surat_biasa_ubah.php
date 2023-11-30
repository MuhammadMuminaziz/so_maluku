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
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
						<div class="col-sm-8 control-label" style="text-align: left;">
							<span class="label label-info">
								<?php echo $surat_biasa->status ?>
							</span>
						</div>
					</div>

					<?php if (isset($surat_biasa->revisi)) : ?>
						<div class=" form-group">
							<label class="col-sm-3 control-label">Catatan revisi <span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<div class="alert alert-warning">
									<?php echo $surat_biasa->revisi ?>
								</div>
							</div>
						</div>
					<?php endif ?>

					<div class="form-group">
						<label class="col-sm-3 control-label">OPD Tujuan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="opdTujuan" name="opdTujuan[]" class="form-control" style="width: 100%" data-placeholder="OPD Tujuan" multiple>
								<option value="">&nbsp;</option>
								<option value="all" <?= count($surat_biasa->list_id_opd) === 0 ? 'selected' : '' ?>>Semua</option>
								<?php
								$list_id_opd = array_column($surat_biasa->list_id_opd, 'id_opd');
								?>
								<?php foreach ($list_opd as $opd) : ?>
									<?php
									$isFound = array_search($opd->id, $list_id_opd);
									?>
									<option value="<?= $opd->id ?>" <?= $isFound !== false ? 'selected' : '' ?>><?= $opd->nama_opd ?></option>
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
									<option value="<?= $kabag->id ?>" <?= $surat_biasa->id_kabag === $kabag->id ? 'selected' : '' ?>><?= $kabag->nama_jabatan ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Jenis Approval</label>
						<div class="col-sm-8" style="padding-top: 10px;">
							<div class="input-group">
								<label class="rdiobox rdiobox-primary">
									<input type="radio" name="is_langsung" value="0" <?= !$surat_biasa->is_langsung ? 'checked' : '' ?>>
									<span>Sekda</span>
								</label>
								<label class="rdiobox rdiobox-primary">
									<input type="radio" name="is_langsung" value="1" <?= $surat_biasa->is_langsung ? 'checked' : '' ?>>
									<span>Kadis</span>
								</label>
							</div>
						</div>
					</div>

					<div class="form-group" id="id_asisten_wrapper">
						<label class="col-sm-3 control-label">Paraf Koord. Asisten Sekda <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="id_asisten" name="id_asisten" class="form-control" style="width: 100%" data-placeholder="Paraf Koord. Asisten Sekda">
								<option value="">&nbsp;</option>
								<?php foreach ($list_asekda as $asekda) : ?>
									<option value="<?= $asekda->id ?>" <?= $surat_biasa->id_asisten === $asekda->id ? 'selected' : '' ?>><?= $asekda->nama_jabatan ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<!-- <div class="form-group">
						<label class="col-sm-3 control-label">Nama Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nama_surat" class="form-control" placeholder="Nama surat" required value="<?php echo $surat_biasa->nama_surat ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nomor_surat" class="form-control" placeholder="Nomor surat" required value="<?php echo $surat_biasa->nomor_surat ?>" />
						</div>
					</div> -->

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" name="tanggal_surat" class="form-control" placeholder="yyyy-mm-dd" id="tanggal_surat" value="<?php echo $surat_biasa->tanggal_surat ?>">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Perihal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="perihal" class="form-control" placeholder="Perihal" required value="<?php echo $surat_biasa->perihal ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Jumlah Lampiran</label>
						<div class="col-sm-8">
							<input type="text" name="lampiran" class="form-control" placeholder="Lampiran" value="<?php echo $surat_biasa->lampiran ?>"/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Lampiran</label>
						<div class="col-sm-8">
							<input type="file" name="file_lampiran" class="form-control" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea id="isi_surat" name="isi_surat" rows="20" class="form-control" placeholder="Isi surat" required><?php echo $surat_biasa->isi_surat ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tembusan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea id="list_tembusan" name="list_tembusan" rows="5" class="form-control" placeholder="Tembusan" required><?php echo $surat_biasa->list_tembusan ?></textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<?php if ($surat_biasa->status === BIASA_DRAFT) : ?>
								<button class="btn btn-info btn-quirk btn-stroke mr5" name="draft">Simpan draft</button>
								<button class="btn btn-success btn-quirk btn-wide mr5" name="kirim" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Kirim</button>
							<?php elseif ($surat_biasa->status === BIASA_WAITING_APPROVAL_KABAG && $current_user->level_jabatan == LEVEL_KABAG_KABID) : ?>
								<button class="btn btn-info btn-quirk btn-stroke mr5" name="kirim" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);">Simpan</button>
							<?php endif ?>
							<a href="/surat_biasa" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>