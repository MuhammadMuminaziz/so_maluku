<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Undangan</a></li>
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
				<h4 class="panel-title">Ubah Surat Undangan</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<?php echo $surat_undangan->status ?>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nomor_surat" class="form-control" placeholder="Nomor surat" required value="<?php echo $surat_undangan->nomor_surat ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal Surat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" name="tanggal_surat" class="form-control" placeholder="yyyy-mm-dd" id="tanggal_surat" value="<?php echo $surat_undangan->tanggal_surat ?>">
								<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Lampiran <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="lampiran" class="form-control" placeholder="Lampiran" required value="<?php echo $surat_undangan->lampiran ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Perihal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="perihal" class="form-control" placeholder="Perihal" required value="<?php echo $surat_undangan->perihal ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi Pendahuluan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="isi_pendahuluan" rows="5" class="form-control" placeholder="Isi pendahuluan" required><?php echo $surat_undangan->isi_pendahuluan ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Isi Penutup <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="isi_penutup" rows="5" class="form-control" placeholder="Isi penutup" required><?php echo $surat_undangan->isi_penutup ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Hari/Tanggal <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="hari_tanggal" class="form-control" placeholder="Hari/Tanggal" required value="<?php echo $surat_undangan->hari_tanggal ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Waktu <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="waktu_kegiatan" class="form-control" placeholder="Waktu" required value="<?php echo $surat_undangan->waktu_kegiatan ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tempat <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="lokasi_kegiatan" class="form-control" placeholder="Tempat" required value="<?php echo $surat_undangan->lokasi_kegiatan ?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">OPD Tujuan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="opdTujuan" name="opdTujuan[]" class="form-control" style="width: 100%" data-placeholder="OPD Tujuan" multiple>
								<option value="">&nbsp;</option>
								<!-- <option value="semua">Semua OPD</option> -->
								<?php
								$list_id_opd = array_column($surat_undangan->list_id_opd, 'id_opd');
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
						<label class="col-sm-3 control-label">Tembusan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<textarea name="list_tembusan" rows="5" class="form-control" placeholder="Tembusan" required><?php echo $surat_undangan->list_tembusan ?></textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<?php if ($surat_undangan->status === UNDANGAN_LANGSUNG_DRAFT) : ?>
								<button class="btn btn-info btn-quirk btn-stroke mr5" name="draft">Simpan draft</button>
								<?php if ($current_user->level_jabatan != LEVEL_KADIS) : ?>
									<button class="btn btn-success btn-quirk btn-wide mr5" name="kirim" onclick="function disabled(e){ $(e).addClass('disabled'); };disabled(this);>Kirim</button>
								<?php endif ?>
							<?php endif ?>
							<a href="/surat_undangan_langsung" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
