<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li><a href="/permohonan">Surat Biasa</a></li>
		<li class="active">Detail</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Detail Surat Biasa</h4>
			</div>
			<div class="panel-body">
				<hr>
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nomor Surat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_masuk->nomor_surat ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Tanggal Surat</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_masuk->tanggal_surat ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Perihal</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_masuk->perihal ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Pengirim</label>
						<div class="col-sm-8">
							<div class="control-label pull-left"><?php echo $surat_masuk->pengirim ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Ringkasan</label>
						<div class="col-sm-8">
							<div class="control-label pull-left" style="text-align: left;"><?php echo $surat_masuk->ringkasan ?></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Dokumen</label>
						<div class="col-sm-8">
							<div class="control-label pull-left" style="text-align: left;">
								<?php if ($surat_masuk->surat_biasa != NULL) : ?>
									<a target="_blank" href="/generated/surat_biasa/<?php echo $surat_masuk->surat_biasa->doc ?>">Download</i></a>
								<?php else : ?>
									<a target="_blank" href="/uploaded/<?php echo $surat_masuk->doc ?>.pdf">Download</i></a>
								<?php endif ?>
							</div>
						</div>
					</div>

					<?php if (isset($surat_masuk->disposisi)) : ?>
						<div class="form-group">
							<label class="col-sm-3 control-label">Catatan Disposisi</label>
							<div class="col-sm-8">
								<div class="control-label pull-left"><?php echo $surat_masuk->disposisi->catatan ?></div>
							</div>
						</div>
					<?php endif ?>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<a href="/<?= $kembali; ?>" class="btn btn-quirk btn-wide btn-default mr5">Kembali</a>
							<?php if (in_array($current_user->id, $list_surat_id) && $current_user->level_jabatan != LEVEL_KASUBAG_KASIE) : ?>
								<br />
								<br />
								<div class="panel-group" id="accordion2">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" class="collapsed" data-parent="#accordion2" href="#collapseOne2">
													Disposisi Surat
												</a>
											</h4>
										</div>
										<div id="collapseOne2" class="panel-collapse collapse">
											<div class="panel-body">
												<form action="/<?= $kembali; ?>/disposisi" method="POST">
													<input type="hidden" name="id_surat_masuk" value="<?php echo $surat_masuk->id ?>" />
													<!-- <div class="form-group">
														<label class="col-sm-3 control-label">Tujuan <span class="text-danger">*</span></label>
														<div class="col-sm-8">
															<select id="id_tujuan" name="id_tujuan" class="form-control" style="width: 100%" data-placeholder="Tujuan" required>
																<option value="">&nbsp;</option>
																<?php foreach ($list_tujuan as $tujuan) : ?>
																	<option value="<?= $tujuan->id ?>"><?= $tujuan->nama_jabatan ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div> -->

													<div class="form-group">
														<label class="col-sm-3 control-label">Tujuan <span class="text-danger">*</span></label>
														<div class="col-sm-8">
															<select id="id_tujuan" name="id_tujuan[]" class="form-control" style="width: 100%" data-placeholder="Tujuan" multiple required>
																<option value="">&nbsp;</option>
																<?php foreach ($list_tujuan as $tujuan) : ?>
																	<option value="<?= $tujuan->id ?>"><?= $tujuan->nama_jabatan ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>

													<textarea id="catatan" name="catatan" rows="5" class="form-control" placeholder="Catatan disposisi"></textarea>
													<br />
													<button class="btn btn-info btn-quirk mr5" name="reject">Disposisi</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							<?php endif ?>
						</div>
					</div>

				</div>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
