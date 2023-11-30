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
				<table id="dataTable1" class="table nomargin">
					<thead>
						<tr>
							<th>Perihal</th>
							<th>Nomor</th>
							<th>OPD Asal</th>
							<th>OPD Tujuan</th>
							<th>Jenis Approval</th>
							<th>Status</th>
							<th>Lampiran</th>
							<th>Status Revisi</th>
							<th class="text-right">Tanggal</th>
							<?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM) : ?>
								<th>
									<center>Buat Surat</center>
								</th>
							<?php else : ?>
								<th></th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php
						$level_menu_surat_biasa = array(LEVEL_KADIS, LEVEL_KABAG_KABID, LEVEL_KASUBAG_KASIE);
						// $level_menu_surat_biasa_create = array(LEVEL_KADIS, LEVEL_SEKDIS, LEVEL_KABAG_KABID, LEVEL_KASUBAG_KASIE);
						$level_menu_surat_biasa_create = array(LEVEL_KASUBAG_KASIE);
						?>
						<?php foreach ($list_surat_biasa as $surat_biasa) : ?>
							<?php if (in_array($current_user->level_jabatan, $level_menu_surat_biasa)) : ?>
								<tr>
									<td><?= $surat_biasa->perihal ?></td>
									<td><?= $surat_biasa->nomor_surat . $surat_biasa->nomor_surat_biro ?></td>
									<td><?= $surat_biasa->nama_opd_from ?></td>
									<td>
										<?php if (empty(trim($surat_biasa->nama_opd_to))) : ?>
											Semua OPD
										<?php else : ?>
											<?= $surat_biasa->nama_opd_to ?>
										<?php endif ?>
									</td>
									<td>
										<?php if ($surat_biasa->is_langsung) : ?>
											<span class="badge badge-primary" style="background-color: #2574ab">Kadis</span>
										<?php else : ?>
											<span class="badge badge-primary" style="background-color: #259dab;">Sekda</span>
										<?php endif ?>
									</td>
									<td>
										<?php if ($surat_biasa->status == BIASA_APPROVED) : ?>
											<a target="_blank" href="/generated/surat_biasa/<?php echo $surat_biasa->doc ?>">Download</i></a>
										<?php else : ?>
											<span class="label label-info">
												<?= $surat_biasa->status ?>
											</span>
										<?php endif ?>
									</td>
									<td>
										<?php if ($surat_biasa->doc_lampiran != null) : ?>
											<?php if ($surat_biasa->status == BIASA_APPROVED) : ?>
												<a target="_blank" href="/lampiran/<?php echo $surat_biasa->doc_lampiran ?>.pdf">Download</i></a>
											<?php else : ?>
												-
											<?php endif ?>
										<?php else : ?>
											<span>
												-
											</span>
										<?php endif ?>
									</td>
									<td><?= isset($surat_biasa->revisi) ? '<span class="label label-warning">Revisi</span>' : '<span class="label label-default">Tidak</span>' ?></td>
									<td class="text-right"><?= $surat_biasa->tanggal_surat ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_biasa/detail/<?php echo $surat_biasa->id ?>"><i class="fa fa-eye"></i></a></li>
											<?php if ($surat_biasa->status === BIASA_DRAFT && in_array($current_user->level_jabatan, $level_menu_surat_biasa_create)) : ?>
												<li><a href="/surat_biasa/ubah/<?php echo $surat_biasa->id ?>"><i class="fa fa-pencil"></i></a></li>
												<li><a href="/surat_biasa/hapus/<?php echo $surat_biasa->id ?>"><i class="fa fa-trash"></i></a></li>
											<?php endif ?>
											<?php if ($surat_biasa->status === BIASA_WAITING_APPROVAL_KABAG && $current_user->level_jabatan == LEVEL_KABAG_KABID) : ?>
												<li><a href="/surat_biasa/ubah/<?php echo $surat_biasa->id ?>"><i class="fa fa-pencil"></i></a></li>
											<?php endif ?>
										</ul>
									</td>
								</tr>
							<?php else : ?>
								<tr>
									<td><?= $surat_biasa->perihal ?></td>
									<td><?= $surat_biasa->nomor_surat . $surat_biasa->nomor_surat_biro ?></td>
									<td><?= $surat_biasa->nama_opd_from ?></td>
									<td>
										<?php if (empty(trim($surat_biasa->nama_opd_to))) : ?>
											Semua OPD
										<?php else : ?>
											<?= $surat_biasa->nama_opd_to ?>
										<?php endif ?>
									</td>
									<td>
										<?php if ($surat_biasa->is_langsung) : ?>
											<span class="badge badge-primary" style="background-color: #2574ab">Kadis</span>
										<?php else : ?>
											<span class="badge badge-primary" style="background-color: #259dab;">Sekda</span>
										<?php endif ?>
									</td>
									<td><?php if ($surat_biasa->status == BIASA_APPROVED) : ?>
											<a target="_blank" href="/generated/surat_biasa/<?php echo $surat_biasa->doc ?>">Download</i></a>
										<?php else : ?>
											<span class="label label-info">
												<?= $surat_biasa->status ?>
											</span>
										<?php endif ?>
									</td>
									<td>
										<?php if ($surat_biasa->doc_lampiran != null) : ?>
											<?php if ($surat_biasa->status == BIASA_APPROVED) : ?>
												<a target="_blank" href="/lampiran/<?php echo $surat_biasa->doc_lampiran ?>.pdf">Download</i></a>
											<?php else : ?>
												<span>
													-
												</span>
											<?php endif ?>
										<?php else : ?>
											<span> - </span>
										<?php endif ?>
									</td>
									<td><?= isset($surat_biasa->revisi) ? '<span class="label label-warning">Revisi</span>' : '<span class="label label-default">Tidak</span>' ?></td>
									<td class="text-right"><?= $surat_biasa->tanggal_surat ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_biasa/detail/<?php echo $surat_biasa->id ?>"><i class="fa fa-eye"></i></a></li>
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