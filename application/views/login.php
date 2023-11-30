<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?= base_url('images/logo_prov.png'); ?>" type="image/png">

	<title>Smart Office Provinsi Maluku</title>

	<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/font-awesome.css'); ?>">

	<link rel="stylesheet" href="<?= base_url('assets/quirk.css'); ?>">

	<script src="<?= base_url('assets/modernizr/modernizr.js'); ?>"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
  <script src="../lib/html5shiv/html5shiv.js"></script>
  <script src="../lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body class="signwrapper">

	<div class="sign-overlay"></div>
	<div class="signpanel"></div>

	<div class="panel signin">
		<div class="panel-heading">
			<center><img src="<?= base_url('images/logo_prov.png'); ?>" width="128px" /></center>
			<br />
			<h1><img src="<?= base_url('images/tifabaileo.png'); ?>" /></h1>
			<h4 class="panel-title">Smart Office Provinsi Maluku</h4>
		</div>
		<?php if ($this->session->flashdata('message_login_error')) : ?>
			<div class="alert alert-danger">
				<center><?= $this->session->flashdata('message_login_error') ?></center>
			</div>
		<?php endif ?>
		<div class="panel-body">
			<form action="" method="POST">
				<div class="form-group mb10">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="username" class="form-control" placeholder="Enter Username" required>
					</div>
				</div>
				<div class="form-group nomargin">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
					</div>
				</div>
				<div><a href="" class="forgot"></a></div>
				<div class="form-group">
					<button class="btn btn-success btn-quirk btn-block">Sign In</button>
				</div>
			</form>
			<hr class="invisible">
		</div>
	</div><!-- panel -->

</body>

</html>
