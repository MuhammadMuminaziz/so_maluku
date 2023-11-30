<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/surat_biasa">Surat</a></li>
		<li class="active">Surat Biasa</li>
	</ol>

	<?php if ($this->session->flashdata('message_success')) : ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?= $this->session->flashdata('message_success') ?>
		</div>
	<?php endif ?>

	<div class="panel">
		<div class="panel-heading">
			<h4 class="panel-title">Surat Biasa</h4>
			<p>Daftar surat biasa.</p>
		</div>
		<div class="panel-body">
			<?php if ($current_user->level_jabatan == LEVEL_KADIS) : ?>
				<div class="row">
					<div class="col-sm-2">
						<div class="form-group">
							<select id="select1" class="form-control" style="width: 100%" data-placeholder="Status">
								<option <?php echo !isset($status) ? 'selected' : '' ?> value="ALL">Semua</option>
								<option <?php echo isset($status) && $status == 'DRAFT' ? 'selected' : '' ?> value="DRAFT">Draft</option>
								<option <?php echo isset($status) && $status == 'WAITING_APPROVAL_BIRO' ? 'selected' : '' ?> value="WAITING_APPROVAL_BIRO">Menunggu Approval Biro</option>
								<option <?php echo isset($status) && $status == 'WAITING_APPROVAL_SEKDA' ? 'selected' : '' ?> value="WAITING_APPROVAL_SEKDA">Menunggu Approval Sekda</option>
								<option <?php echo isset($status) && $status == 'APPROVED' ? 'selected' : '' ?> value="APPROVED">Diterima</option>
							</select>
						</div>
					</div>
				</div>
			<?php endif ?>

			<div class="table-responsive">
				<table class="table nomargin">
					<thead>
						<tr>
							<th>Perihal</th>
							<th>Nomor</th>
							<th>Dokumen</th>
							<th class="text-right">Tanggal</th>
							<?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_ADMIN) : ?>
								<th>
									<center>Buat Surat</center>
								</th>
							<?php else : ?>
								<th></th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($list_surat_biasa as $surat_biasa) : ?>
							<?php if ($current_user->level_jabatan == LEVEL_KADIS) : ?>
								<tr>
									<td><?= $surat_biasa->perihal ?></td>
									<td><?= $surat_biasa->nomor_surat ?></td>
									<td>
										<a target="_blank" href="/generated/surat_biasa/<?php echo $surat_biasa->doc ?>">Download</i></a>
									</td>
									<td class="text-right"><?= $surat_biasa->tanggal_surat ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_biasa_masuk/detail/<?php echo $surat_biasa->id ?>"><i class="fa fa-eye"></i></a></li>
										</ul>
									</td>
								</tr>
							<?php elseif ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_ADMIN) : ?>
								<tr>
									<td><?= $surat_biasa->perihal ?></td>
									<td><?= $surat_biasa->nomor_surat ?></td>
									<td>
										<a target="_blank" href="/generated/surat_biasa/<?php echo $surat_biasa->doc ?>">Download</i></a>
									</td>
									<td class="text-right"><?= $surat_biasa->tanggal_surat ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_biasa_masuk/detail/<?php echo $surat_biasa->id ?>"><i class="fa fa-eye"></i></a></li>
										</ul>
									</td>
								</tr>
							<?php else : ?>
								<tr>
									<td><?= $surat_biasa->nama_surat ?></td>
									<td><?= $surat_biasa->nomor_surat ?></td>
									<td>
										<?php if ($surat_biasa->status == UNDANGAN_APPROVED) : ?>
											<a target="_blank" href="/generated/surat_biasa/<?php echo $surat_biasa->doc ?>">Download</i></a>
										<?php else : ?>
											<?= $surat_biasa->status ?>
										<?php endif ?>
									</td>
									<td class="text-right"><?= $surat_biasa->tanggal_surat ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_biasa_masuk/detail/<?php echo $surat_biasa->id ?>"><i class="fa fa-eye"></i></a></li>
										</ul>
									</td>
								</tr>
							<?php endif ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div><!-- table-responsive -->
		</div>
	</div><!-- panel -->
</div>
