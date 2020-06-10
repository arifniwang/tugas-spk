<?php
session_start();
if (isset($_SESSION['login'])) header('Location: dashboard-ui.php');
include 'lhast.php';
include 'dbconf.php';
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'layout/head.php'; ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		
		<a href="#"><b><?php echo $_SESSION['judul']; ?></b> SYSTEM</a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p align="center" class="login-box-msg">Silahkan login untuk melanjutkan</p>
		
		<form method="post" action="">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Username" name="user" id="user" required/>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" name="pass" id="pass" required/>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<a href="registrasi.php" class="text-center">Registrasi akun baru</a>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-success btn-block btn-flat">Login</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
	
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php include 'layout/plugin.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST && $_POST['user'] != '' && $_POST['pass'] != '') {
		$user = $mysqli->query("SELECT * FROM `user` WHERE `user` = '" . $_POST['user'] . "' and `pass` = '" . md5($_POST['pass']) . "'");
		$karyawan = $mysqli->query("SELECT * FROM `karyawan` WHERE `email` = '" . $_POST['user'] . "' and `password` = '" . md5($_POST['pass']) . "'");
		if ($user->num_rows != 0) {
			while ($row = $user->fetch_assoc()) {
				$_SESSION['login'] = uniqid();
				$_SESSION['id'] = $row['id'];
				$_SESSION['user'] = $row['user'];
				$_SESSION['pass'] = $row['pass'];
				$_SESSION['level'] = 'admin';
				$_SESSION['since'] = $row['since'];
				$_SESSION['foto'] = $row['foto'];
			} ?>
			<script>
				location.href = "dashboard-ui.php";
			</script>
		<?php } elseif ($karyawan->num_rows != 0) {
		while ($row = $karyawan->fetch_assoc()) {
			$_SESSION['login'] = uniqid();
			$_SESSION['id'] = $row['id_karyawan'];
			$_SESSION['user'] = $row['nama'];
			$_SESSION['pass'] = $row['password'];
			$_SESSION['level'] = 'karyawan';
			$_SESSION['since'] = '';
			$_SESSION['foto'] = $row['foto'];
		} ?>
			<script>
				location.href = "dashboard-ui.php";
			</script>
		<?php } else { ?>
			<script>
				swal({
					title: 'Login Error!',
					text: 'Maaf Username atau Password salah..',
					type: 'error',
					confirmButtonText: 'OK'
				})
			</script>
		<?php }
		$q1 = "SELECT * FROM `user` WHERE `user` = '" . $_POST['user'] . "' and `pass` = '" . md5($_POST['pass']) . "'";
		$q2 = "SELECT * FROM `karyawan` WHERE `email` = '" . $_POST['user'] . "' and `password` = '" . md5($_POST['pass']) . "'";
	}
	if (@$_POST['user'] == '')
		echo " username harus diisi..";
	if (@$_POST['pass'] == '')
		echo " password harus diisi..";
}
?>
</body>
</html>