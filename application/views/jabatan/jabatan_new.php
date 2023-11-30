<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/dinas">Jabatan</a></li>
		<li class="active">Tambah</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Tambah Jabatan Baru</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Jabatan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nama_jabatan" class="form-control" placeholder="Nama Jabatan" required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Level Jabatan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="id_level_jabatan" class="select2" name="id_level_jabatan" style="width: 100%" data-placeholder="Level Jabatan" required>
								<option value="">&nbsp;</option>
								<?php foreach ($list_level_jabatan as $level_jabatan) : ?>
									<option value="<?= $level_jabatan->id ?>"><?= $level_jabatan->nama ?></option>
								<?php endforeach ?>
							</select>
							<label class="error" for="id_level_jabatan"></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">OPD/Dinas</label>
						<div class="col-sm-8">
							<?php
							$is_admin_opd = $current_user->level_jabatan == LEVEL_ADMIN_OPD
							?>
							<?php if ($is_admin_opd) : ?>
								<input type="hidden" name="id_opd" value="<?= $current_user->id_opd ?>" />
							<?php endif ?>
							<select id="id_opd" class="select2" name="id_opd" style="width: 100%" data-placeholder="OPD/Dinas" <?= $is_admin_opd ? 'disabled' : '' ?>>
								<option value="">&nbsp;</option>
								<?php foreach ($list_opd as $opd) : ?>
									<?php
									$is_selected = $is_admin_opd && $opd->id == $current_user->id_opd
									?>
									<option value="<?= $opd->id ?>" <?= $is_selected ? 'selected' : '' ?>><?= $opd->nama_opd ?></option>
								<?php endforeach ?>
							</select>
							<label class="error" for="id_opd"></label>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-info btn-quirk mr5">Simpan</button>
							<button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
							<a href="/jabatan" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>