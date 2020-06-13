<?php
session_start();
if (isset($_SESSION['login'])) header('Location: dashboard-ui.php');
include 'lhast.php';
include 'dbconf.php';
$menu = 'registrasi';
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'layout/head.php'; ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a href="index.php"><b>ENERGI</b> BANGSA</a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p align="center" class="login-box-msg">Registrasi akun baru</p>
		
		<form method="post" action="proses-registrasi.php" enctype="multipart/form-data">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required/>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			
			<div class="form-group has-feedback">
				<input type="email" class="form-control" name="email" id="email" placeholder="Email" required/>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" name="pass" id="pass" required/>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			
			<div class="row">
				<div class="col-xs-8">
					<a href="login-ui.php" class="text-center">Kembali ke halaman Login</a>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-success btn-block btn-flat">submit</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
	
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include 'layout/plugin.php'; ?>
<!-- CUSTOMIZE JAVASCRIPT -->
<script>
	$(function () {
		setTimeout(function () {
			$('input').val("");
		}, 400)
	})
</script>
</body>
</html>