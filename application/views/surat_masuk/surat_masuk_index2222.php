<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li class="active">Surat Masuk</li>
	</ol>

	<?php if ($this->session->flashdata('message_success')) : ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?= $this->session->flashdata('message_success') ?>
		</div>
	<?php endif ?>

	<div class="panel">
		<div class="panel-heading">
			<h4 class="panel-title">Surat Masuk</h4>
			<p>Daftar surat masuk.</p>
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
								<option <?php echo isset($status) && $status == 'REJECTED' ? 'selected' : '' ?> value="REJECTED">Ditolak</option>
							</select>
						</div>
					</div>
				</div>
			<?php endif ?>

			<div class="table-responsive">
				<table class="table nomargin">
					<thead>
						<tr>
							<th>Nomor</th>
							<th>Hal</th>
							<th>Tempat</th>
							<th>Status</th>
							<th class="text-right">Tanggal</th>
							<?php if ($current_user->level_jabatan == LEVEL_KADIS) : ?>
								<th>SPT</th>
								<th>SPPD</th>
							<?php endif ?>
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
						<?php foreach ($list_permohonan as $permohonan) : ?>
							<?php if ($current_user->level_jabatan == LEVEL_KADIS) : ?>
								<tr>
									<td><?= $permohonan->nomor ?></td>
									<td><?= $permohonan->hal ?></td>
									<td><?= $permohonan->tempat ?></td>
									<td><?= $permohonan->status ?></td>
									<td class="text-right"><?= $permohonan->tanggal ?></td>
									<td><?= $permohonan->spt_status ?></td>
									<td><?= $permohonan->spt_status ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_masuk/detail/<?php echo $permohonan->id ?>"><i class="fa fa-eye"></i></a></li>
											<?php if ($permohonan->status === PERMOHONAN_DRAFT) : ?>
												<li><a href="/surat_masuk/ubah/<?php echo $permohonan->id ?>"><i class="fa fa-pencil"></i></a></li>
												<li><a href="/surat_masuk/hapus/<?php echo $permohonan->id ?>"><i class="fa fa-trash"></i></a></li>
											<?php endif ?>
										</ul>
									</td>
								</tr>
							<?php elseif ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_ADMIN) : ?>
								<tr>
									<td><?= $permohonan->nomor ?></td>
									<td><?= $permohonan->hal ?></td>
									<td><?= $permohonan->tempat ?></td>
									<td><?= $permohonan->status ?></td>
									<td class="text-right"><?= $permohonan->tanggal ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_masuk/detail/<?php echo $permohonan->id ?>"><i class="fa fa-eye"></i></a></li>
											<li><a href="/surat_masuk/spt/<?php echo $permohonan->id ?>">SPT</i></a></li>
											<li><a href="/surat_masuk/sppd_new/<?php echo $permohonan->id ?>">SPPD</i></a></li>
										</ul>
									</td>
								</tr>
							<?php else : ?>
								<tr>
									<td><?= $permohonan->nomor ?></td>
									<td><?= $permohonan->hal ?></td>
									<td><?= $permohonan->tempat ?></td>
									<td><?= $permohonan->status ?></td>
									<td class="text-right"><?= $permohonan->tanggal ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_masuk/detail/<?php echo $permohonan->id ?>"><i class="fa fa-eye"></i></a></li>
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
