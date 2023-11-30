<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="/surat_pemberitahuan">Surat</a></li>
		<li class="active">Surat Biasa OPD</li>
	</ol>

	<?php if ($this->session->flashdata('message_success')) : ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?= $this->session->flashdata('message_success') ?>
		</div>
	<?php endif ?>

	<div class="panel">
		<div class="panel-heading">
			<h4 class="panel-title">Surat Biasa OPD</h4>
			<p>Daftar surat biasa OPD.</p>
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
					<div class="col-sm-10">
						<a class="btn btn-success" href="/surat_pemberitahuan_langsung/new">Tambah</a>
					</div>
				</div>
			<?php endif ?>

			<div class="table-responsive">
				<table class="table nomargin">
					<thead>
						<tr>
							<th>Nomor</th>
							<th>Perihal</th>
							<th>OPD Asal</th>
							<th>OPD Tujuan</th>
							<th>Status</th>
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
						<?php foreach ($list_surat_pemberitahuan as $surat_pemberitahuan) : ?>
							<?php if ($current_user->level_jabatan == LEVEL_KADIS) : ?>
								<tr>
									<td><?= $surat_pemberitahuan->nomor_surat ?></td>
									<td><?= $surat_pemberitahuan->perihal ?></td>
									<td><?= $surat_pemberitahuan->nama_opd_from ?></td>
									<td><?= $surat_pemberitahuan->nama_opd_to ?></td>
									<td>
										<?php if ($surat_pemberitahuan->status == PEMBERITAHUAN_LANGSUNG_APPROVED) : ?>
											<a target="_blank" href="/generated/surat_pemberitahuan_langsung/<?php echo $surat_pemberitahuan->doc ?>">Download</i></a>
										<?php else : ?>
											<?= $surat_pemberitahuan->status ?>
										<?php endif ?>
									</td>
									<td class="text-right"><?= $surat_pemberitahuan->tanggal_surat ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_pemberitahuan_langsung/detail/<?php echo $surat_pemberitahuan->id ?>"><i class="fa fa-eye"></i></a></li>
											<?php if ($surat_pemberitahuan->status === PEMBERITAHUAN_LANGSUNG_DRAFT) : ?>
												<li><a href="/surat_pemberitahuan_langsung/ubah/<?php echo $surat_pemberitahuan->id ?>"><i class="fa fa-pencil"></i></a></li>
												<li><a href="/surat_pemberitahuan_langsung/hapus/<?php echo $surat_pemberitahuan->id ?>"><i class="fa fa-trash"></i></a></li>
											<?php endif ?>
										</ul>
									</td>
								</tr>
							<?php elseif ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_ADMIN) : ?>
								<tr>
									<td><?= $surat_pemberitahuan->nomor_surat ?></td>
									<td><?= $surat_pemberitahuan->perihal ?></td>
									<td><?= $surat_pemberitahuan->status ?></td>
									<td class="text-right"><?= $surat_pemberitahuan->tanggal_surat ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_pemberitahuan_langsung/detail/<?php echo $surat_pemberitahuan->id ?>"><i class="fa fa-eye"></i></a></li>
										</ul>
									</td>
								</tr>
							<?php else : ?>
								<tr>
									<td><?= $surat_pemberitahuan->nomor_surat ?></td>
									<td><?= $surat_pemberitahuan->perihal ?></td>
									<td><?= $surat_pemberitahuan->nama_opd_from ?></td>
									<td><?= $surat_pemberitahuan->nama_opd_to ?></td>
									<td>
										<?php if ($surat_pemberitahuan->status == PEMBERITAHUAN_LANGSUNG_APPROVED) : ?>
											<a target="_blank" href="/generated/surat_pemberitahuan_langsung/<?php echo $surat_pemberitahuan->doc ?>">Download</i></a>
										<?php else : ?>
											<?= $surat_pemberitahuan->status ?>
										<?php endif ?>
									</td>
									<td class="text-right"><?= $surat_pemberitahuan->tanggal_surat ?></td>
									<td>
										<ul class="table-options">
											<li><a href="/surat_pemberitahuan_langsung/detail/<?php echo $surat_pemberitahuan->id ?>"><i class="fa fa-eye"></i></a></li>
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