<!doctype html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="msapplication-TileColor" content="#0061da">
	<meta name="theme-color" content="#1643a3">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

	<!-- Title -->
	<title>adminor – Clean & Modern Responsive Bootstrap 4 admin dashboard HTML5 Template.</title>
	<link rel="stylesheet" href="<?= base_url('') ?>assets\fonts\fonts\font-awesome.min.css">

	<!-- Font Family -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

	<!-- Sidemenu Css -->
	<link href="<?= base_url('') ?>assets\plugins\fullside-menu\css\style.css" rel="stylesheet">
	<link href="<?= base_url('') ?>assets\plugins\fullside-menu\waves.min.css" rel="stylesheet">

	<!-- Dashboard Css -->
	<link href="<?= base_url('') ?>assets\css\dashboard.css" rel="stylesheet">

	<!-- c3.js Charts Plugin -->
	<link href="<?= base_url('') ?>assets\plugins\charts-c3\c3-chart.css" rel="stylesheet">

	<!-- Custom scroll bar css-->
	<link href="<?= base_url('') ?>assets\plugins\scroll-bar\jquery.mCustomScrollbar.css" rel="stylesheet">

	<!---Font icons-->
	<link href="<?= base_url('') ?>assets\css\icons.css" rel="stylesheet">

</head>

<body>
	<div class="login-img">
		<div id="global-loader"></div>
		<div class="page">
			<div class="page-single">
				<div class="container">
					<div class="row authentication">
						<div class="col col-login mx-auto">
							<div class="text-center mb-6">
								<img src="<?= base_url('') ?>assets\images\brand\logo.png" class="h-8" alt="">
							</div>
							<form class="card" action="<?= base_url('c_login/cek_login') ?>" method="post">
								<div class="card-body p-6 ">
									<div class="card-title text-center">Login to your Account</div>
									<center>
										<span class="badge badge-gradient-danger mb-3" id="warning" style="display: none;">
											<?= $this->session->flashdata('warning') ?>
										</span>
									</center>
									<div class="input-icon form-group wrap-input">
										<span class="input-icon-addon search-icon">
											<i class="mdi mdi-account"></i>
										</span>
										<input type="text" name="uname" class="form-control" placeholder="Username">
									</div>
									<div class="input-icon form-group wrap-input">
										<span class="input-icon-addon search-icon">
											<i class="zmdi zmdi-lock"></i>
										</span>
										<input type="password" name="upass" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password">
									</div>
									<div class="form-group mt-5">
										<label class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input">
											<span class="custom-control-label">Remember me</span>
										</label>
									</div>
									<div class="form-footer">
										<button type="submit" class="btn btn-primary btn-block">Sign in</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Dashboard js -->
	<script src="<?= base_url('') ?>assets\js\vendors\jquery-3.2.1.min.js"></script>
	<script src="<?= base_url('') ?>assets\js\vendors\bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('') ?>assets\js\vendors\jquery.sparkline.min.js"></script>
	<script src="<?= base_url('') ?>assets\js\vendors\selectize.min.js"></script>
	<script src="<?= base_url('') ?>assets\js\vendors\jquery.tablesorter.min.js"></script>
	<script src="<?= base_url('') ?>assets\js\vendors\circle-progress.min.js"></script>
	<script src="<?= base_url('') ?>assets\plugins\rating\jquery.rating-stars.js"></script>

	<!-- Fullside-menu Js-->
	<script src="<?= base_url('') ?>assets\plugins\fullside-menu\jquery.slimscroll.min.js"></script>
	<script src="<?= base_url('') ?>assets\plugins\fullside-menu\waves.min.js"></script>

	<!-- Custom scroll bar Js-->
	<script src="<?= base_url('') ?>assets\plugins\scroll-bar\jquery.mCustomScrollbar.concat.min.js"></script>

	<!-- Custom Js-->
	<script src="<?= base_url('') ?>assets\js\custom.js"></script>
	<?php if ($this->session->flashdata('warning')) : ?>
		<script>
			$(document).ready(function() {
				$("#warning").fadeIn(2000);
				$('#warning').delay(3000).fadeOut();
			});
		</script>
	<?php endif; ?>
</body>

</html>