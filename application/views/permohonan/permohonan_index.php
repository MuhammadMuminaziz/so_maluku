<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/permohonan">Surat</a></li>
		<li class="active">Surat Permohonan</li>
	</ol>

	<?php if ($this->session->flashdata('message_success')) : ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?= $this->session->flashdata('message_success') ?>
		</div>
	<?php endif ?>

	<div class="panel">
		<div class="panel-heading">
			<h4 class="panel-title">Surat Permohonan</h4>
			<p>Daftar surat permohonan.</p>
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
				<table id="dataTable1" class="table nomargin">
					<?php
					$level_menu_permohonan = array(LEVEL_TU, LEVEL_KADIS, LEVEL_SEKDIS, LEVEL_KABAG_KABID, LEVEL_KASUBAG_KASIE);
					$level_menu_permohonan_create = array(LEVEL_KASUBAG_KASIE);
					?>
					<thead>
						<tr>
							<th>OPD Pengirim</th>
							<th>Nomor</th>
							<th>Hal</th>
							<th>Dari</th>
							<th>Ke</th>
							<th>Status</th>
							<th class="text-right">Tanggal</th>
							<th class="text-right">Tanggal Perjalanan</th>
							<?php if (in_array($current_user->level_jabatan, $level_menu_permohonan)) : ?>
								<th>SPT</th>
								<th>SPPD</th>
							<?php endif ?>
							<?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_ADMIN) : ?>
								<th>
									<center>Buat Surat</center>
								</th>
								<th></th>
							<?php else : ?>
								<th></th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($list_permohonan as $permohonan) : ?>
							<?php if (in_array($current_user->level_jabatan, $level_menu_permohonan)) : ?>
								<tr>
									<td><?= $permohonan->nama_opd ?></td>
									<td><?= $permohonan->nomor_surat ?></td>
									<td><?= $permohonan->hal ?></td>
									<td><?= $permohonan->dari ?></td>
									<td><?= $permohonan->ke ?></td>
									<td>
										<span class="label label-info">
											<?= $permohonan->status ?>
										</span>
									</td>
									<td class="text-right"><?= $permohonan->tanggal ?></td>
									<td class="text-right"><?= $permohonan->tanggal_berangkat ?> - <?= $permohonan->tanggal_pulang ?></td>
									<td>
										<?php if ($permohonan->spt_status == SPT_FINAL) : ?>
											<a href="/permohonan/spt/<?php echo $permohonan->id ?>">Download</i></a>
										<?php else : ?>
											<?= $permohonan->spt_status ?>
										<?php endif ?>
									</td>
									<td>
										<?php if ($permohonan->spt_status == SPT_FINAL) : ?>
											<a href="/permohonan/spt/<?php echo $permohonan->id ?>/true">Download</i></a>
										<?php endif ?>
									</td>
									<td>
										<ul class="table-options">
											<li><a href="/permohonan/detail/<?php echo $permohonan->id ?>"><i class="fa fa-eye"></i></a></li>
											<?php if ($permohonan->status === PERMOHONAN_DRAFT && in_array($current_user->level_jabatan, $level_menu_permohonan_create)) : ?>
												<li><a href="/permohonan/ubah/<?php echo $permohonan->id ?>"><i class="fa fa-pencil"></i></a></li>
												<li><a href="/permohonan/hapus/<?php echo $permohonan->id ?>"><i class="fa fa-trash"></i></a></li>
											<?php endif ?>
											<?php if ($permohonan->status === PERMOHONAN_WAITING_APPROVAL_KABAG && $current_user->level_jabatan == LEVEL_KABAG_KABID) : ?>
												<li><a href="/permohonan/ubah/<?php echo $permohonan->id ?>"><i class="fa fa-pencil"></i></a></li>
											<?php endif ?>
										</ul>
									</td>
								</tr>
							<?php elseif ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_ADMIN) : ?>
								<tr>
									<td><?= $permohonan->nama_opd ?></td>
									<td><?= $permohonan->nomor_surat ?></td>
									<td><?= $permohonan->hal ?></td>
									<td><?= $permohonan->dari ?></td>
									<td><?= $permohonan->ke ?></td>
									<td>
										<span class="label label-info">
											<?= $permohonan->status ?>
										</span>
									</td>
									<td class="text-right"><?= $permohonan->tanggal ?></td>
									<td class="text-right"><?= $permohonan->tanggal_berangkat ?> - <?= $permohonan->tanggal_pulang ?></td>
									<td>
										<ul class="table-options">
											<!-- <li><a href="/permohonan/detail/<?php echo $permohonan->id ?>"><i class="fa fa-eye"></i></a></li> -->
											<li><a href="/permohonan/spt/<?php echo $permohonan->id ?>">SPT</i></a></li>
											<?php if ($permohonan->spt_status == SPT_FINAL) : ?>
												<li><a href="/permohonan/spt/<?php echo $permohonan->id ?>/true">SPPD</i></a></li>
											<?php endif ?>
										</ul>
									</td>
									<td>
										<ul class="table-options">
											<li><a href="/permohonan/detail/<?php echo $permohonan->id ?>"><i class="fa fa-eye"></i></a></li>
										</ul>
									</td>
								</tr>
							<?php else : ?>
								<tr>
									<td><?= $permohonan->nama_opd ?></td>
									<td><?= $permohonan->nomor_surat ?></td>
									<td><?= $permohonan->hal ?></td>
									<td><?= $permohonan->dari ?></td>
									<td><?= $permohonan->ke ?></td>
									<td>
										<span class="label label-info">
											<?= $permohonan->status ?>
										</span>
									</td>
									<td class="text-right"><?= $permohonan->tanggal ?></td>
									<td class="text-right"><?= $permohonan->tanggal_berangkat ?> - <?= $permohonan->tanggal_pulang ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/permohonan/detail/<?php echo $permohonan->id ?>"><i class="fa fa-eye"></i></a></li>
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