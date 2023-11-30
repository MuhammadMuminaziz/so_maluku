<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li class="active">Opt. OPD</li>
	</ol>

	<?php if ($this->session->flashdata('message_success')) : ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?= $this->session->flashdata('message_success') ?>
		</div>
	<?php endif ?>

	<div class="panel">
		<div class="panel-heading">
			<h4 class="panel-title">Opt. OPD</h4>
			<p>Daftar Opt. OPD.</p>
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
					<thead>
						<tr>
							<th>Username</th>
							<th>Nama</th>
							<th>NIP</th>
							<th>OPD</th>
							<th>Jabatan</th>
							<th>Pangkat/Golongan</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($list_user as $user) : ?>
							<tr>
								<td><?= $user->username ?></td>
								<td><?= $user->nama ?></td>
								<td><?= $user->nip ?></td>
								<td><?= $user->nama_opd ?></td>
								<td><?= $user->nama_jabatan ?></td>
								<td><?= $user->pangkat ?>/<?= $user->golongan ?><?= $user->ruang ?></td>
								<td>
									<ul class="table-options">
										<li><a href="/user/ubah_opt/<?php echo $user->id ?>"><i class="fa fa-pencil"></i></a></li>
										<li><a href="/user/hapus_opt/<?php echo $user->id ?>"><i class="fa fa-trash"></i></a></li>
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
