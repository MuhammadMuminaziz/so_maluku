<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/user">User</a></li>
		<li class="active">Tambah</li>
	</ol>

	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading nopaddingbottom">
				<h4 class="panel-title">Tambah Opt. OPD Baru</h4>
				<p>Pastikan informasi sudah jelas.</p>
			</div>
			<div class="panel-body">
				<hr>
				<form id="basicForm" action="" class="form-horizontal" method="POST">
					<div class="form-group">
						<label class="col-sm-3 control-label">Username <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="username" class="form-control" placeholder="Username" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Password <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="password" name="password" class="form-control" placeholder="Password" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Lengkap <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">NIP <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="text" name="nip" class="form-control" placeholder="NIP" required />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Email</label>
						<div class="col-sm-8">
							<input type="text" name="email" class="form-control" placeholder="Email" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">No. Telp</label>
						<div class="col-sm-8">
							<input type="text" name="no_telp" class="form-control" placeholder="No. Telp" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">OPD <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="id_opd" class="select2" name="id_opd" style="width: 100%" data-placeholder="OPD" required>
								<option value="">&nbsp;</option>
								<?php foreach ($list_opd as $opd) : ?>
									<option value="<?= $opd->id ?>"><?= $opd->nama_opd ?></option>
								<?php endforeach ?>
							</select>
							<label class="error" for="id_opd"></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Jabatan <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<select id="id_jabatan" class="select2" name="id_jabatan" style="width: 100%" data-placeholder="Jabatan" required>
								<option value="">&nbsp;</option>
								<?php foreach ($list_jabatan as $jabatan) : ?>
									<option value="<?= $jabatan->id ?>"><?= $jabatan->nama_jabatan ?></option>
								<?php endforeach ?>
							</select>
							<label class="error" for="id_jabatan"></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Pangkat/Golongan</label>
						<div class="col-sm-8">
							<select id="id_pangkat_gol" class="select2" name="id_pangkat_gol" style="width: 100%" data-placeholder="Pangkat/Golongan">
								<option value="">&nbsp;</option>
								<?php foreach ($list_pangkat_gol as $pangkat_gol) : ?>
									<option value="<?= $pangkat_gol->id ?>"><?= $pangkat_gol->pangkat ?>/<?= $pangkat_gol->golongan ?><?= $pangkat_gol->ruang ?></option>
								<?php endforeach ?>
							</select>
							<label class="error" for="id_jabatan"></label>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-info btn-quirk mr5">Simpan</button>
							<button type="reset" class="btn btn-quirk btn-wide btn-default">Reset</button>
							<a href="/user" class="btn btn-quirk btn-wide btn-default">Kembali</a>
						</div>
					</div>

				</form>
			</div><!-- panel-body -->
		</div><!-- panel -->

	</div><!-- col-md-6 -->
</div>
