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
		<a href="#"><b><?php echo $_SESSION['judul']; ?></b> SYSTEM</a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p align="center" class="login-box-msg">Registrasi akun baru</p>
		
		<form method="post" action="proses-registrasi.php" enctype="multipart/form-data">
			<div class="form-group has-feedback">
				<input type="file" class="form-control" placeholder="Foto" name="foto" id="foto" required/>
				<span class="glyphicon glyphicon-picture form-control-feedback"></span>
				<small>Max file size 5MB</small>
			</div>
			
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required/>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon" required/>
				<span class="glyphicon glyphicon-phone form-control-feedback"></span>
			</div>
			
			<div class="form-group has-feedback">
				<input type="email" class="form-control" name="email" id="email" placeholder="Email" required/>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" name="pass" id="pass" required/>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required/>
				<span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
			</div>
			
			<div class="form-group has-feedback">
				<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" style="padding-right: 15px;">
					<option value='laki-laki'>Laki-laki</option>
					<option value='perempuan'>Perempuan</option>
				</select>
			</div>
			
			<hr>
			<?php
			$query = "SELECT * FROM `kriteria`";
			$result = $mysqli->query($query);
			?>
			
			<?php if ($result->num_rows > 0): ?>
				<?php while ($row = $result->fetch_assoc()): $row = (object)$row; ?>
					
					<div class="form-group">
						<?php
						// tipe pilihan
						if ($row->tipe == 'Option'):
							$sub_query = "SELECT * FROM `sub_kriteria` WHERE id_kriteria = $row->id_kriteria";
							$sub_result = $mysqli->query($sub_query);
							?>
							<select class="form-control" name="sub_kriteria[<?php echo $row->id_kriteria; ?>]" id="<?php echo $row->kriteria; ?>">
								<option value=""><?php echo $row->kriteria ?></option>
								<?php while ($xrow = $sub_result->fetch_assoc()): $xrow = (object)$xrow; ?>
									<option value='<?php echo $xrow->id_sub_kriteria; ?>'><?php echo $xrow->sub_kriteria ?></option>
								<?php endwhile; ?>
							</select>
						
						<?php
						//tipe numerik
						else: ?>
							<?php if ($row->limit == 0): ?>
								<input type="number" class="form-control" name="sub_kriteria[<?php echo $row->id_kriteria; ?>]" id="<?php echo $row->kriteria; ?>"
								       placeholder="<?php echo $row->kriteria ?>">
							<?php else:
								$sql = "SELECT MIN(`min`) as min FROM `sub_kriteria` WHERE id_kriteria = $row->id_kriteria";
								$min = $mysqli->query($sql)->fetch_assoc()['min'];
								
								$sql = "SELECT MAX(`max`) as max FROM `sub_kriteria` WHERE id_kriteria = $row->id_kriteria";
								$max = $mysqli->query($sql)->fetch_assoc()['max'];
								?>
								<input type="number" class="form-control" name="sub_kriteria[<?php echo $row->id_kriteria; ?>]" id="<?php echo $row->kriteria; ?>"
								       placeholder="<?php echo $row->kriteria ?>" min="<?php echo $min; ?>" max="<?php echo $max; ?>">
							<?php endif; ?>
						<?php endif; ?>
					</div>
				
				<?php endwhile; ?>
			<?php endif; ?>
			
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