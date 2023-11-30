<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?= base_url('images/logo_prov.png'); ?>" type="image/png">

	<title>Smart Office Provinsi Maluku</title>
	<link rel="stylesheet" href="<?= base_url('assets/Hover/hover.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/font-awesome.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/weather-icons/css/weather-icons.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/ionicons/css/ionicons.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/jquery-toggles/toggles-full.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/select2/select2.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/morrisjs/morris.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/jquery-ui/jquery-ui.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/dropzone/dropzone.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/timepicker/jquery.timepicker.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/bootstrapcolorpicker/css/bootstrap-colorpicker.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>">

	<link rel="stylesheet" href="<?= base_url('assets/quirk.css'); ?>">

	<script src="<?= base_url('assets/modernizr/modernizr.js'); ?>"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
  <script src="../lib/html5shiv/html5shiv.js"></script>
  <script src="../lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body>

	<header>
		<div class="headerpanel" style="margin-top:20px;">

			<div class="logopanel">
				<h2 style="text-align:center;"><a href="index.html"><img src="<?= base_url('images/tifabaileo.png'); ?>" height="41" /></a></h2>
			</div><!-- logopanel -->

			<div class="headerbar">

				<a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

				<!-- <div class="searchpanel">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div> -->

				<div class="header-right">
					<ul class="headermenu">
						<!-- <li>
							<div id="noticePanel" class="btn-group">
								<button class="btn btn-notice alert-notice" data-toggle="dropdown">
									<i class="fa fa-globe"></i>
								</button>
								<div id="noticeDropdown" class="dropdown-menu dm-notice pull-right">
									<div role="tabpanel">
										<ul class="nav nav-tabs nav-justified" role="tablist">
											<li class="active"><a data-target="#notification" data-toggle="tab">Notifications (2)</a></li>
											<li><a data-target="#reminders" data-toggle="tab">Reminders (4)</a></li>
										</ul>

										<div class="tab-content">
											<div role="tabpanel" class="tab-pane active" id="notification">
												<ul class="list-group notice-list">
													<li class="list-group-item unread">
														<div class="row">
															<div class="col-xs-2">
																<i class="fa fa-envelope"></i>
															</div>
															<div class="col-xs-10">
																<h5><a href="">New message from Weno Carasbong</a></h5>
																<small>June 20, 2015</small>
																<span>Soluta nobis est eligendi optio cumque...</span>
															</div>
														</div>
													</li>
													<li class="list-group-item unread">
														<div class="row">
															<div class="col-xs-2">
																<i class="fa fa-user"></i>
															</div>
															<div class="col-xs-10">
																<h5><a href="">Renov Leonga is now following you!</a></h5>
																<small>June 18, 2015</small>
															</div>
														</div>
													</li>
													<li class="list-group-item">
														<div class="row">
															<div class="col-xs-2">
																<i class="fa fa-user"></i>
															</div>
															<div class="col-xs-10">
																<h5><a href="">Zaham Sindil is now following you!</a></h5>
																<small>June 17, 2015</small>
															</div>
														</div>
													</li>
													<li class="list-group-item">
														<div class="row">
															<div class="col-xs-2">
																<i class="fa fa-thumbs-up"></i>
															</div>
															<div class="col-xs-10">
																<h5><a href="">Rey Reslaba likes your post!</a></h5>
																<small>June 16, 2015</small>
																<span>HTML5 For Beginners Chapter 1</span>
															</div>
														</div>
													</li>
													<li class="list-group-item">
														<div class="row">
															<div class="col-xs-2">
																<i class="fa fa-comment"></i>
															</div>
															<div class="col-xs-10">
																<h5><a href="">Socrates commented on your post!</a></h5>
																<small>June 16, 2015</small>
																<span>Temporibus autem et aut officiis debitis...</span>
															</div>
														</div>
													</li>
												</ul>
												<a class="btn-more" href="">View More Notifications <i class="fa fa-long-arrow-right"></i></a>
											</div>

											<div role="tabpanel" class="tab-pane" id="reminders">
												<h1 id="todayDay" class="today-day">...</h1>
												<h3 id="todayDate" class="today-date">...</h3>

												<h5 class="today-weather"><i class="wi wi-hail"></i> Cloudy 77 Degree</h5>
												<p>Thunderstorm in the area this afternoon through this evening</p>

												<h4 class="panel-title">Upcoming Events</h4>
												<ul class="list-group">
													<li class="list-group-item">
														<div class="row">
															<div class="col-xs-2">
																<h4>20</h4>
																<p>Aug</p>
															</div>
															<div class="col-xs-10">
																<h5><a href="">HTML5/CSS3 Live! United States</a></h5>
																<small>San Francisco, CA</small>
															</div>
														</div>
													</li>
													<li class="list-group-item">
														<div class="row">
															<div class="col-xs-2">
																<h4>05</h4>
																<p>Sep</p>
															</div>
															<div class="col-xs-10">
																<h5><a href="">Web Technology Summit</a></h5>
																<small>Sydney, Australia</small>
															</div>
														</div>
													</li>
													<li class="list-group-item">
														<div class="row">
															<div class="col-xs-2">
																<h4>25</h4>
																<p>Sep</p>
															</div>
															<div class="col-xs-10">
																<h5><a href="">HTML5 Developer Conference 2015</a></h5>
																<small>Los Angeles CA United States</small>
															</div>
														</div>
													</li>
													<li class="list-group-item">
														<div class="row">
															<div class="col-xs-2">
																<h4>10</h4>
																<p>Oct</p>
															</div>
															<div class="col-xs-10">
																<h5><a href="">AngularJS Conference 2015</a></h5>
																<small>Silicon Valley CA, United States</small>
															</div>
														</div>
													</li>
												</ul>
												<a class="btn-more" href="">View More Events <i class="fa fa-long-arrow-right"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li> -->
						<li>
							<div class="btn-group">
								<button type="button" class="btn btn-logged" data-toggle="dropdown">
									<!-- <img src="<?= base_url('images/photos/loggeduser.png'); ?>" alt="" /> -->
									<?php echo $current_user->nama ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right">
									<!-- <li><a href="profile.html"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
									<li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
									<li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li> -->
									<li><a href="/auth/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
								</ul>
							</div>
						</li>
						<!-- <li>
							<button id="chatview" class="btn btn-chat alert-notice">
								<span class="badge-alert"></span>
								<i class="fa fa-comments-o"></i>
							</button>
						</li> -->
					</ul>
				</div><!-- header-right -->
			</div><!-- headerbar -->
		</div><!-- header-->
	</header>

	<section>

		<div class="leftpanel">
			<div class="leftpanelinner">

				<!-- ################## LEFT PANEL PROFILE ################## -->

				<div class="media leftpanel-profile">
					<!-- <div class="media-left">
						<a href="#">
							<img src="<?= base_url('images/photos/loggeduser.png'); ?>" alt="" class="media-object img-circle">
						</a>
					</div> -->
					<div class="media-body">
						<h4 class="media-heading"><?php echo $current_user->nama ?>
							<!-- <a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a> -->
						</h4>
						<span><?php echo $current_user->nama_jabatan ?></span>
					</div>
				</div><!-- leftpanel-profile -->

				<div class="leftpanel-userinfo collapse" id="loguserinfo">
					<h5 class="sidebar-title">Address</h5>
					<address>
						4975 Cambridge Road
						Miami Gardens, FL 33056
					</address>
					<h5 class="sidebar-title">Contact</h5>
					<ul class="list-group">
						<li class="list-group-item">
							<label class="pull-left">Email</label>
							<span class="pull-right">me@themepixels.com</span>
						</li>
						<li class="list-group-item">
							<label class="pull-left">Home</label>
							<span class="pull-right">(032) 1234 567</span>
						</li>
						<li class="list-group-item">
							<label class="pull-left">Mobile</label>
							<span class="pull-right">+63012 3456 789</span>
						</li>
						<li class="list-group-item">
							<label class="pull-left">Social</label>
							<div class="social-icons pull-right">
								<a href="#"><i class="fa fa-facebook-official"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-pinterest"></i></a>
							</div>
						</li>
					</ul>
				</div><!-- leftpanel-userinfo -->

				<ul class="nav nav-tabs nav-justified nav-sidebar">
					<li class="tooltips active" data-toggle="tooltip" title="Main Menu"><a data-toggle="tab" data-target="#mainmenu"><i class="tooltips fa fa-ellipsis-h"></i></a></li>
					<!-- <li class="tooltips unread" data-toggle="tooltip" title="Check Mail"><a data-toggle="tab" data-target="#emailmenu"><i class="tooltips fa fa-envelope"></i></a></li>
					<li class="tooltips" data-toggle="tooltip" title="Contacts"><a data-toggle="tab" data-target="#contactmenu"><i class="fa fa-user"></i></a></li>
					<li class="tooltips" data-toggle="tooltip" title="Settings"><a data-toggle="tab" data-target="#settings"><i class="fa fa-cog"></i></a></li> -->
					<li class="tooltips" data-toggle="tooltip" title="Log Out"><a href="/auth/logout"><i class="fa fa-sign-out"></i></a></li>
				</ul>

				<div class="tab-content">

					<!-- ################# MAIN MENU ################### -->

					<div class="tab-pane active" id="mainmenu">
						<!-- <h5 class="sidebar-title">Main Menu</h5> -->
						<ul class="nav nav-pills nav-stacked nav-quirk">
							<li <?php if ($this->uri->uri_string() == "dashboard") {
									echo 'class="active"';
								} ?>><a href="/dashboard"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
							<!-- <li><a href="widgets.html"><span class="badge pull-right">10+</span><i class="fa fa-cube"></i> <span>Widgets</span></a></li>
							<li><a href="maps.html"><i class="fa fa-map-marker"></i> <span>Maps</span></a></li> -->
						</ul>

						<?php
						$level_menu_surat_permohonan = array(LEVEL_GUB, LEVEL_WAKIL_GUB, LEVEL_SEKDA, LEVEL_KABIRO, LEVEL_KADIS, LEVEL_SEKDIS, LEVEL_KABAG_KABID, LEVEL_TU, LEVEL_KASUBAG_KASIE, LEVEL_ADMIN_OPD);
						$level_menu_surat_permohonan_create = array(LEVEL_KASUBAG_KASIE);
						$level_menu_surat_masuk = array(LEVEL_GUB, LEVEL_WAKIL_GUB, LEVEL_SEKDA, LEVEL_KABIRO, LEVEL_KADIS, LEVEL_TU, LEVEL_KABAG_KABID, LEVEL_KASUBAG_KASIE);
						$level_menu_surat_keluar = array(LEVEL_KADIS, LEVEL_KABAG_KABID, LEVEL_KASUBAG_KASIE);
						$level_menu_surat_undangan = array(LEVEL_GUB, LEVEL_WAKIL_GUB, LEVEL_SEKDA, LEVEL_KABIRO, LEVEL_KADIS);
						$level_menu_surat_undangan_langsung = array(LEVEL_KADIS, LEVEL_KABAG_KABID, LEVEL_KASUBAG_KASIE);
						$level_menu_surat_biasa = array(LEVEL_KADIS, LEVEL_KABAG_KABID, LEVEL_KASUBAG_KASIE);
						$level_menu_surat_biasa_masuk = array(LEVEL_KADIS, LEVEL_KABAG_KABID, LEVEL_KASUBAG_KASIE);
						$level_menu_surat_biasa_keluar = array(LEVEL_SEKDA, LEVEL_ASISTEN, LEVEL_KADIS, LEVEL_SEKDIS, LEVEL_KABAG_KABID, LEVEL_TU, LEVEL_KASUBAG_KASIE, LEVEL_ADMIN_OPD);
						$level_menu_surat_biasa_create = array(LEVEL_KASUBAG_KASIE);
						$level_menu_surat_masuk_create = array(LEVEL_TU);
						$is_biro_umum = $current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_UMUM;
						?>
						<?php if (in_array($current_user->level_jabatan, $level_menu_surat_masuk) || in_array($current_user->level_jabatan, $level_menu_surat_undangan_langsung) || in_array($current_user->level_jabatan, $level_menu_surat_biasa)) : ?>
							<h5 class="sidebar-title"><i class="fa fa-envelope"></i> Surat Masuk</h5>
							<ul class="nav nav-pills nav-stacked nav-quirk">
								<!-- <?php if (in_array($current_user->level_jabatan, $level_menu_surat_biasa_masuk) || $is_biro_umum) : ?>
									<li class="nav-parent <?php if ($this->uri->segment(1) == "surat_biasa_masuk") {
																echo 'active';
															} ?>">
										<a href=""><span>Surat Masuk Internal</span></a>
										<ul class="children">
											<li <?php if ($this->uri->uri_string() == "surat_biasa_masuk") {
													echo 'class="active"';
												} ?>><a href="/surat_biasa_masuk">Semua</a></li>
										</ul>
									</li>
								<?php endif ?> -->
								<!-- <li class="nav-parent <?php if ($this->uri->segment(1) == "surat_masuk") {
																echo 'active';
															} ?>">
									<a href=""><span>Surat Masuk</span></a>
									<ul class="children">
										<li <?php if ($this->uri->uri_string() == "surat_masuk") {
												echo 'class="active"';
											} ?>><a href="/surat_masuk">Semua</a></li>
										<?php if (in_array($current_user->level_jabatan, $level_menu_surat_masuk_create) || $is_biro_umum) : ?>

											<li <?php if ($this->uri->uri_string() == "surat_masuk/new") {
													echo 'class="active"';
												} ?>><a href="/surat_masuk/new">Tambah</a></li>

										<?php endif ?>
									</ul>
								</li> -->

								<li class="nav-parent <?php if ($this->uri->segment(1) === "surat_masuk") {
															echo 'active';
														} ?>">
									<a href=""><span>Surat Opd</span></a>
									<ul class="children">
										<li <?php if ($this->uri->uri_string() === "surat_masuk") {
												echo 'class="active"';
											} ?>><a href="/surat_masuk">Semua</a></li>
									</ul>
								</li>
								<li class="nav-parent <?php if ($this->uri->segment(1) == "surat_masuk_luar_opd") {
															echo 'active';
														} ?>">
									<a href=""><span>Surat Luar Opd</span></a>
									<ul class="children">
										<li <?php if ($this->uri->uri_string() == "surat_masuk_luar_opd") {
												echo 'class="active"';
											} ?>><a href="/surat_masuk_luar_opd">Semua</a></li>

										<?php if (in_array($current_user->level_jabatan, $level_menu_surat_masuk_create) || $is_biro_umum) : ?>
											<li <?php if ($this->uri->uri_string() == "surat_masuk_luar_opd/new") {
													echo 'class="active"';
												} ?>><a href="/surat_masuk_luar_opd/new">Tambah</a></li>
										<?php endif ?>
									</ul>
								</li>

								<!-- <li <?php if ($this->uri->uri_string() == "surat_masuk") {
												echo 'class="active"';
											} ?>><a href="/surat_masuk">Opd</a></li> -->

								<!-- <?php if (in_array($current_user->level_jabatan, $level_menu_surat_masuk_create) || $is_biro_umum) : ?>

									<li <?php if ($this->uri->uri_string() == "surat_masuk/new") {
												echo 'class="active"';
											} ?>><a href="/surat_masuk/new">Tambah</a></li>

								<?php endif ?> -->
							</ul>
						<?php endif ?>

						<?php if (in_array($current_user->level_jabatan, $level_menu_surat_permohonan) || in_array($current_user->level_jabatan, $level_menu_surat_undangan) || in_array($current_user->level_jabatan, $level_menu_surat_biasa_keluar) || $is_biro_umum) : ?>
							<h5 class="sidebar-title"><i class="fa fa-envelope"></i> Surat Keluar</h5>
							<ul class="nav nav-pills nav-stacked nav-quirk">
								<?php if (in_array($current_user->level_jabatan, $level_menu_surat_permohonan)) : ?>
									<li class="nav-parent <?php if ($this->uri->segment(1) == "permohonan") {
																echo 'active';
															} ?>">
										<a href=""><span>Surat Permohonan</span></a>
										<ul class="children">
											<li <?php if ($this->uri->uri_string() == "permohonan") {
													echo 'class="active"';
												} ?>><a href="/permohonan">Semua</a></li>
											<?php if (in_array($current_user->level_jabatan, $level_menu_surat_permohonan_create)) : ?>
												<li <?php if ($this->uri->uri_string() == "permohonan/new") {
														echo 'class="active"';
													} ?>><a href="/permohonan/new">Tambah</a></li>
											<?php endif ?>
										</ul>
									</li>
								<?php endif ?>

								<?php if (in_array($current_user->level_jabatan, $level_menu_surat_biasa_keluar) || $is_biro_umum) : ?>
									<li class="nav-parent <?php if ($this->uri->segment(1) == "surat_biasa") {
																echo 'active';
															} ?>">
										<a href=""><span>Surat Biasa</span></a>
										<ul class="children">
											<li <?php if ($this->uri->uri_string() == "surat_biasa") {
													echo 'class="active"';
												} ?>><a href="/surat_biasa">Semua</a></li>
											<?php if (in_array($current_user->level_jabatan, $level_menu_surat_biasa_create)) : ?>
												<li <?php if ($this->uri->uri_string() == "surat_biasa/new") {
														echo 'class="active"';
													} ?>><a href="/surat_biasa/new">Tambah</a></li>
											<?php endif ?>
										</ul>
									</li>
								<?php endif ?>

								<!-- <?php if (in_array($current_user->level_jabatan, $level_menu_surat_undangan)) : ?>
									<?php if ($current_user->level_jabatan == LEVEL_KABIRO && $current_user->id_jabatan == JABATAN_BIRO_ADMIN) : ?>
									<?php else : ?>
										<?php
												$list_surat_biasa = array("surat_undangan", "surat_undangan_langsung", "surat_pemberitahuan", "surat_pemberitahuan_langsung")
										?>
										<li class="nav-parent <?php if (in_array($this->uri->segment(1), $list_surat_biasa)) {
																	echo 'active';
																} ?>">
											<a href=""><span>Surat Biasa</span></a>
											<ul class="children">
												<li <?php if ($this->uri->uri_string() == "surat_undangan") {
														echo 'class="active"';
													} ?>><a href="/surat_undangan">Surat Undangan</a></li>
												<li <?php if ($this->uri->uri_string() == "surat_undangan_langsung") {
														echo 'class="active"';
													} ?>><a href="/surat_undangan_langsung">Surat Undangan OPD</a></li>
												<li <?php if ($this->uri->uri_string() == "surat_pemberitahuan") {
														echo 'class="active"';
													} ?>><a href="/surat_pemberitahuan">Surat Biasa</a></li>
												<li <?php if ($this->uri->uri_string() == "surat_pemberitahuan_langsung") {
														echo 'class="active"';
													} ?>><a href="/surat_pemberitahuan_langsung">Surat Biasa OPD</a></li>
											</ul>
										</li>
									<?php endif ?>
								<?php endif ?> -->
							</ul>
						<?php endif ?>

						<?php if ($current_user->level_jabatan == LEVEL_ADMIN_OPD) : ?>
							<h5 class="sidebar-title"><i class="fa fa-envelope"></i> Kelola</h5>
							<ul class="nav nav-pills nav-stacked nav-quirk">
								<li class="nav-parent <?php if ($this->uri->segment(1) == "jabatan") {
															echo 'active';
														} ?>">
									<a href=""><i class="fa fa-envelope"></i> <span>Jabatan OPD</span></a>
									<ul class="children">
										<li <?php if ($this->uri->uri_string() == "jabatan") {
												echo 'class="active"';
											} ?>><a href="/jabatan">Semua</a></li>
										<li <?php if ($this->uri->uri_string() == "jabatan/new") {
												echo 'class="active"';
											} ?>><a href="/jabatan/new">Tambah</a></li>
									</ul>
								</li>
								<li class="nav-parent <?php if ($this->uri->segment(1) == "user") {
															echo 'active';
														} ?>">
									<a href=""><i class="fa fa-envelope"></i> <span>User OPD</span></a>
									<ul class="children">
										<li <?php if ($this->uri->uri_string() == "user/for_opt") {
												echo 'class="active"';
											} ?>><a href="/user/for_opt">Semua</a></li>
										<li <?php if ($this->uri->uri_string() == "user/new_for_opt") {
												echo 'class="active"';
											} ?>><a href="/user/new_for_opt">Tambah</a></li>
									</ul>
								</li>
								<li <?php if ($this->uri->uri_string() == "opd/ubah_for_opt") {
										echo 'class="active"';
									} ?>><a href="/opd/ubah_for_opt"><i class="fa fa-cube"></i> <span>Profil OPD</span></a></li>
							</ul>
						<?php endif ?>

						<?php if ($current_user->level_jabatan == LEVEL_ADMIN) : ?>
							<h5 class="sidebar-title"><i class="fa fa-envelope"></i> Kelola</h5>
							<ul class="nav nav-pills nav-stacked nav-quirk">
								<li class="nav-parent <?php if ($this->uri->segment(1) == "jabatan") {
															echo 'active';
														} ?>">
									<a href=""><i class="fa fa-envelope"></i> <span>Jabatan</span></a>
									<ul class="children">
										<li <?php if ($this->uri->uri_string() == "jabatan") {
												echo 'class="active"';
											} ?>><a href="/jabatan">Semua</a></li>
										<li <?php if ($this->uri->uri_string() == "jabatan/new") {
												echo 'class="active"';
											} ?>><a href="/jabatan/new">Tambah</a></li>
									</ul>
								</li>
								<li class="nav-parent <?php if ($this->uri->segment(1) == "opd") {
															echo 'active';
														} ?>">
									<a href=""><i class="fa fa-envelope"></i> <span>OPD</span></a>
									<ul class="children">
										<li <?php if ($this->uri->uri_string() == "opd") {
												echo 'class="active"';
											} ?>><a href="/opd">Semua</a></li>
										<?php if ($current_user->level_jabatan == LEVEL_ADMIN) : ?>
											<li <?php if ($this->uri->uri_string() == "opd/new") {
													echo 'class="active"';
												} ?>><a href="/opd/new">Tambah</a></li>
										<?php endif ?>
									</ul>
								</li>
								<li class="nav-parent <?php if ($this->uri->segment(1) == "user" && strpos($this->uri->segment(2), "opt") !== FALSE) {
															echo 'active';
														} ?>">
									<a href=""><i class="fa fa-envelope"></i> <span>Operator OPD</span></a>
									<ul class="children">
										<li <?php if ($this->uri->uri_string() == "user/opt") {
												echo 'class="active"';
											} ?>><a href="/user/opt">Semua</a></li>
										<?php if ($current_user->level_jabatan == LEVEL_ADMIN) : ?>
											<li <?php if ($this->uri->uri_string() == "user/new_opt") {
													echo 'class="active"';
												} ?>><a href="/user/new_opt">Tambah</a></li>
										<?php endif ?>
									</ul>
								</li>
								<li class="nav-parent <?php if ($this->uri->segment(1) == "user" && strpos($this->uri->segment(2), "provinsi") !== FALSE) {
															echo 'active';
														} ?>">
									<a href=""><i class="fa fa-envelope"></i> <span>Akun Provinsi</span></a>
									<ul class="children">
										<li <?php if ($this->uri->uri_string() == "user/provinsi") {
												echo 'class="active"';
											} ?>><a href="/user/provinsi">Semua</a></li>
										<?php if ($current_user->level_jabatan == LEVEL_ADMIN) : ?>
											<li <?php if ($this->uri->uri_string() == "user/new_provinsi") {
													echo 'class="active"';
												} ?>><a href="<?= site_url('/user/new_provinsi'); ?>">Tambah</a></li>
										<?php endif ?>
									</ul>
								</li>
							</ul>
						<?php endif ?>

						<h5 class="sidebar-title"><i class="fa fa-envelope"></i> Lainnya</h5>
						<ul class="nav nav-pills nav-stacked nav-quirk">
							<li class="<?php if ($this->uri->segment(1) == "ubah_profil") {
											echo 'active';
										} ?>">
								<a href="/user/ubah_profil"><span>Ubah Profil</span></a>
							</li>
							<li class="<?php if ($this->uri->segment(1) == "ubah_password") {
											echo 'active';
										} ?>">
								<a href="/user/ubah_password"><span>Ubah Password</span></a>
							</li>
							<li class="<?php if ($this->uri->segment(1) == "buku_panduan") {
											echo 'active';
										} ?>">
								<a href="/files/ManualBookVersion1.0.pdf"><span>Buku Panduan</span></a>
							</li>
							<li class="<?php if ($this->uri->segment(1) == "video_tutorial") {
											echo 'active';
										} ?>">
								<a href="https://www.youtube.com/watch?v=Vr6FcG-ln9g"><span>Video Tutorial</span></a>
							</li>
						</ul>
					</div><!-- tab-pane -->

					<!-- ######################## EMAIL MENU ##################### -->

					<!-- <div class="tab-pane" id="emailmenu">
						<div class="sidebar-btn-wrapper">
							<a href="compose.html" class="btn btn-danger btn-block">Compose</a>
						</div>

						<h5 class="sidebar-title">Mailboxes</h5>
						<ul class="nav nav-pills nav-stacked nav-quirk nav-mail">
							<li><a href="email.html"><i class="fa fa-inbox"></i> <span>Inbox (3)</span></a></li>
							<li><a href="email.html"><i class="fa fa-pencil"></i> <span>Draft (2)</span></a></li>
							<li><a href="email.html"><i class="fa fa-paper-plane"></i> <span>Sent</span></a></li>
						</ul>

						<h5 class="sidebar-title">Tags</h5>
						<ul class="nav nav-pills nav-stacked nav-quirk nav-label">
							<li><a href="#"><i class="fa fa-tags primary"></i> <span>Communication</span></a></li>
							<li><a href="#"><i class="fa fa-tags success"></i> <span>Updates</span></a></li>
							<li><a href="#"><i class="fa fa-tags warning"></i> <span>Promotions</span></a></li>
							<li><a href="#"><i class="fa fa-tags danger"></i> <span>Social</span></a></li>
						</ul>
					</div> -->
					<!-- tab-pane -->

					<!-- ################### CONTACT LIST ################### -->

					<!-- <div class="tab-pane" id="contactmenu">
						<div class="input-group input-search-contact">
							<input type="text" class="form-control" placeholder="Search contact">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
							</span>
						</div>
						<h5 class="sidebar-title">My Contacts</h5>
						<ul class="media-list media-list-contacts">
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user1.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Christina R. Hill</h4>
										<span><i class="fa fa-phone"></i> 386-752-1860</span>
									</div>
								</a>
							</li>
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user2.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Floyd M. Romero</h4>
										<span><i class="fa fa-mobile"></i> +1614-650-8281</span>
									</div>
								</a>
							</li>
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user3.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Jennie S. Gray</h4>
										<span><i class="fa fa-phone"></i> 310-757-8444</span>
									</div>
								</a>
							</li>
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user4.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Alia J. Locher</h4>
										<span><i class="fa fa-mobile"></i> +1517-386-0059</span>
									</div>
								</a>
							</li>
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user5.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Nicholas T. Hinkle</h4>
										<span><i class="fa fa-skype"></i> nicholas.hinkle</span>
									</div>
								</a>
							</li>
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user6.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Jamie W. Bradford</h4>
										<span><i class="fa fa-phone"></i> 225-270-2425</span>
									</div>
								</a>
							</li>
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user7.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Pamela J. Stump</h4>
										<span><i class="fa fa-mobile"></i> +1773-879-2491</span>
									</div>
								</a>
							</li>
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user8.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Refugio C. Burgess</h4>
										<span><i class="fa fa-mobile"></i> +1660-627-7184</span>
									</div>
								</a>
							</li>
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user9.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Ashley T. Brewington</h4>
										<span><i class="fa fa-skype"></i> ashley.brewington</span>
									</div>
								</a>
							</li>
							<li class="media">
								<a href="#">
									<div class="media-left">
										<img class="media-object img-circle" src="<?= base_url('images/photos/user10.png'); ?>" alt="">
									</div>
									<div class="media-body">
										<h4 class="media-heading">Roberta F. Horn</h4>
										<span><i class="fa fa-phone"></i> 716-630-0132</span>
									</div>
								</a>
							</li>
						</ul>
					</div> -->
					<!-- tab-pane -->

					<!-- #################### SETTINGS ################### -->

					<!-- <div class="tab-pane" id="settings">
						<h5 class="sidebar-title">General Settings</h5>
						<ul class="list-group list-group-settings">
							<li class="list-group-item">
								<h5>Daily Newsletter</h5>
								<small>Get notified when someone else is trying to access your account.</small>
								<div class="toggle-wrapper">
									<div class="leftpanel-toggle toggle-light success"></div>
								</div>
							</li>
							<li class="list-group-item">
								<h5>Call Phones</h5>
								<small>Make calls to friends and family right from your account.</small>
								<div class="toggle-wrapper">
									<div class="leftpanel-toggle-off toggle-light success"></div>
								</div>
							</li>
						</ul>
						<h5 class="sidebar-title">Security Settings</h5>
						<ul class="list-group list-group-settings">
							<li class="list-group-item">
								<h5>Login Notifications</h5>
								<small>Get notified when someone else is trying to access your account.</small>
								<div class="toggle-wrapper">
									<div class="leftpanel-toggle toggle-light success"></div>
								</div>
							</li>
							<li class="list-group-item">
								<h5>Phone Approvals</h5>
								<small>Use your phone when login as an extra layer of security.</small>
								<div class="toggle-wrapper">
									<div class="leftpanel-toggle toggle-light success"></div>
								</div>
							</li>
						</ul>
					</div> -->
					<!-- tab-pane -->


				</div><!-- tab-content -->

			</div><!-- leftpanelinner -->
		</div><!-- leftpanel -->

		<div class="mainpanel">

			<?php echo $contents ?>

		</div><!-- mainpanel -->
	</section>

	<script src="<?= base_url('assets/jquery/jquery.js'); ?>"></script>
	<script src="<?= base_url('assets/jquery-ui/jquery-ui.js'); ?>"></script>
	<script src="<?= base_url('assets/bootstrap/js/bootstrap.js'); ?>"></script>
	<script src="<?= base_url('assets/jquery-autosize/autosize.js'); ?>"></script>
	<script src="<?= base_url('assets/select2/select2.js'); ?>"></script>
	<script src="<?= base_url('assets/jquery-toggles/toggles.js'); ?>"></script>
	<script src="<?= base_url('assets/jquery-maskedinput/jquery.maskedinput.js'); ?>"></script>
	<script src="<?= base_url('assets/timepicker/jquery.timepicker.js'); ?>"></script>
	<script src="<?= base_url('assets/dropzone/dropzone.js'); ?>"></script>
	<script src="<?= base_url('assets/jquery-validate/jquery.validate.js'); ?>"></script>
	<script src="<?= base_url('assets/bootstrapcolorpicker/js/bootstrap-colorpicker.js'); ?>"></script>
	<script src="<?= base_url('assets/wysihtml5x/wysihtml5x.js'); ?>"></script>
	<script src="<?= base_url('assets/wysihtml5x/wysihtml5x-toolbar.js'); ?>"></script>
	<script src="<?= base_url('assets/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.all.js'); ?>"></script>
	<script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
	<script src="<?= base_url('assets/datatables/jquery.dataTables.js'); ?>"></script>
	<script src="<?= base_url('assets/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js'); ?>"></script>


	<script src="<?= base_url('assets/js/quirk.js'); ?>"></script>

	<?php if (isset($scripts)) echo $scripts ?>
	<script>
		$(document).ready(function() {
			$('#dataTable1').DataTable();

			function download_file(file, lampiran) {
				window.location.href = '/generated/surat_biasa/' + file;
				if (lampiran != null) {
					window.location.href = '/lampiran/' + lampiran;
				}
			}
		})
	</script>

	<!-- <script>
		$(document).ready(function() {

			'use strict';

			// Basic Form
			$('#basicForm').validate({
				highlight: function(element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				success: function(element) {
					$(element).closest('.form-group').removeClass('has-error');
				}
			});

			// Error Message In One Container
			$('#basicForm2').validate({
				errorLabelContainer: jQuery('#basicForm2 div.error')
			});

			// With Checkboxes and Radio Buttons
			$('#basicForm3').validate({
				highlight: function(element) {
					jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				success: function(element) {
					jQuery(element).closest('.form-group').removeClass('has-error');
				}
			});

			// Validation with select boxes
			$('#basicForm4').validate({
				highlight: function(element) {
					jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				success: function(element) {
					jQuery(element).closest('.form-group').removeClass('has-error');
				}
			});

			$('.select2').select2();

			// Select2 Box
			$('#select1, #select2, #select3').select2();
			$("#select4").select2({
				maximumSelectionLength: 2
			});
			$("#select5").select2({
				minimumResultsForSearch: Infinity
			});
			$("#select6").select2({
				tags: true
			});
		});
	</script> -->
</body>

</html>