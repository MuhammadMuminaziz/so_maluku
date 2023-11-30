<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<!-- <li><a href="/permohonan">Surat</a></li> -->
		<li class="active">Manage Dinas</li>
	</ol>

	<?php if ($this->session->flashdata('message_success')) : ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?= $this->session->flashdata('message_success') ?>
		</div>
	<?php endif ?>

	<div class="panel">
		<div class="panel-heading">
			<h4 class="panel-title">Dinas</h4>
			<p>Daftar dinas.</p>
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
							<th>Nama OPD</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($list_opd as $opd) : ?>
							<tr>
								<td><?= $opd->nama_opd ?></td>
								<td>
									<ul class="table-options">
										<!-- <li><a href="/opd/detail/<?php echo $opd->id ?>"><i class="fa fa-eye"></i></a></li> -->
										<li><a href="/opd/ubah/<?php echo $opd->id ?>"><i class="fa fa-pencil"></i></a></li>
										<?php if ($opd->count_jabatan == 0) : ?>
											<li><a href="/opd/hapus/<?php echo $opd->id ?>"><i class="fa fa-trash"></i></a></li>
										<?php endif ?>
									</ul>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div><!-- table-responsive -->
		</div>
	</div><!-- panel -->
</div>
