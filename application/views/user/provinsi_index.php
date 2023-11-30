<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li class="active">Akun Provinsi</li>
	</ol>

	<?php if ($this->session->flashdata('message_success')) : ?>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?= $this->session->flashdata('message_success') ?>
		</div>
	<?php endif ?>

	<div class="panel">
		<div class="panel-heading">
			<h4 class="panel-title">Akun Provinsi</h4>
			<p>Daftar Akun Provinsi.</p>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table nomargin">
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
										<li><a href="/user/ubah_provinsi/<?php echo $user->id ?>"><i class="fa fa-pencil"></i></a></li>
										<li><a href="/user/hapus_provinsi/<?php echo $user->id ?>"><i class="fa fa-trash"></i></a></li>
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
