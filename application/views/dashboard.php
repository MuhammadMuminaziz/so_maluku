<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="contentpanel">
	<ol class="breadcrumb breadcrumb-quirk">
		<!-- <li><a href="/dashboard"><i class="fa fa-home mr5"></i> Dashboard</a></li>
		<li><a href="general-forms.html">Forms</a></li>
		<li class="active">Form Validation</li> -->
	</ol>

	<div class="row">

		<div class="col-md-12 col-lg-8 dash-left">

			<?php if ($user->level_jabatan != 11) : ?>
				<div class="row">

					<?php if ($user->level_jabatan != 5) : ?>
						<?php if ($user->level_jabatan != 12 && $user->level_jabatan != 13) : ?>
							<div class="col-md-3 col-sm-6">
								<a href="/surat_masuk">
									<div class="panel panel-site-traffic">
										<div class="panel-body">
											<h1 class="text-success nomargin"><?= $surat_opd; ?></h1>
											<hr class="mb-0" style="margin:5px 0;">
											<p class="nomargin" style="margin: 0;">SURAT OPD</p>
										</div>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6">
								<a href="/surat_masuk_luar_opd">
									<div class="panel panel-site-traffic">
										<div class="panel-body">
											<h1 class="text-success nomargin"><?= $surat_luar_opd; ?></h1>
											<hr class="mb-0" style="margin:5px 0;">
											<p class="nomargin" style="margin: 0;">SURAT LUAR OPD</p>
										</div>
									</div>
								</a>
							</div>
						<?php endif; ?>

						<div class="col-md-3 col-sm-6">
							<a href="/permohonan">
								<div class="panel panel-site-traffic">
									<div class="panel-body">
										<h1 class="text-success nomargin"><?= $surat_permohonan; ?></h1>
										<hr class="mb-0" style="margin:5px 0;">
										<p class="nomargin" style="margin: 0;">SURAT PERMOHONAN</p>
									</div>
								</div>
							</a>
						</div>
					<?php endif; ?>

					<?php if ($user->level_jabatan != 1 && $user->id_jabatan != 7) : ?>
						<div class="col-md-3 col-sm-6">
							<a href="/surat_biasa">
								<div class="panel panel-site-traffic">
									<div class="panel-body">
										<h1 class="text-success nomargin"><?= $surat_biasa; ?></h1>
										<hr class="mb-0" style="margin:5px 0;">
										<p class="nomargin" style="margin: 0;">SURAT BIASA</p>
									</div>
								</div>
							</a>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="panel panel-site-traffic">
				<div class="panel-heading">
					<!-- <ul class="panel-options">
						<li><a><i class="fa fa-refresh"></i></a></li>
					</ul> -->
					<h2 class="text-success">Smart Office Provinsi Maluku</h2>
					<p class="nomargin">Selamat datang.</p>
					<p>Fitur Smart Office (Version 1.0)</p>
					<p>- Pembuatan Surat Keluar antar OPD
						<br>- Pembuatan SPT (Surat Perintah Tugas)
						<br>- Pembuatan SPPD (Surat Perintah Perjalanan Dinas)
						<br>- Disposisi Surat Masuk Internal OPD
					</p>
				</div>
				<div class="panel-body">
					<div class="row">

					</div><!-- row -->

					<div class="mb20"></div>

					<div id="basicflot" style="height: 263px"></div>

				</div><!-- panel-body -->
			</div>
		</div>

	</div>
	<!--row -->
</div>

<script>
	$(document).ready(function() {
		// 'use strict';

		// // Basic Form
		// $('#basicForm').validate({
		// 	highlight: function(element) {
		// 		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		// 	},
		// 	success: function(element) {
		// 		$(element).closest('.form-group').removeClass('has-error');
		// 	}
		// });

		// // Error Message In One Container
		// $('#basicForm2').validate({
		// 	errorLabelContainer: jQuery('#basicForm2 div.error')
		// });

		// // With Checkboxes and Radio Buttons
		// $('#basicForm3').validate({
		// 	highlight: function(element) {
		// 		jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		// 	},
		// 	success: function(element) {
		// 		jQuery(element).closest('.form-group').removeClass('has-error');
		// 	}
		// });

		// // Validation with select boxes
		// $('#basicForm4').validate({
		// 	highlight: function(element) {
		// 		jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		// 	},
		// 	success: function(element) {
		// 		jQuery(element).closest('.form-group').removeClass('has-error');
		// 	}
		// });

		// $('.select2').select2();

		// // Select2 Box
		// $('#select1, #select2, #select3').select2();
		// $("#select4").select2({
		// 	maximumSelectionLength: 2
		// });
		// $("#select5").select2({
		// 	minimumResultsForSearch: Infinity
		// });
		// $("#select6").select2({
		// 	tags: true
		// });
	});
</script>