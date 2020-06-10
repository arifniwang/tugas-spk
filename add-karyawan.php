<?php
session_start();
include 'dbconf.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
$menu = 'karyawan';
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'layout/head.php'; ?>
</head>
<body class="hold-transition fixed skin-green sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	
	<header class="main-header">
		<?php include 'layout/header.php'; ?>
	</header> <!-- /.header -->
	
	<aside class="main-sidebar">
		<?php include 'layout/sidebar.php'; ?>
	</aside> <!-- /.sidebar -->
	
	<div class="content-wrapper">
		<section class="content-header">
			<h1 class="text-success">Karyawan</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard-ui.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="karyawan.php">Data Karyawan</a></li>
				<li><a href="add-karyawan.php">Tambah Data</a></li>
			</ol>
		</section><!-- /.content-header -->
		
		<section class="content">
			<div class="box box-success">
				
				<div class="box-header with-border">
					<h3 class="box-title text-success"><i class="fa fa-users"> </i> Tambah Data Karyawan</h3>
				</div><!-- box-header-->
				
				<!-- form start -->
				<form class="form-horizontal" enctype="multipart/form-data" method="post" action="proses-karyawan.php">
					<div class="row">
						<div class="col-xs-12">
							
							<div class="box-body">
								<div class="form-group">
									<label for="foto" class="col-sm-2 control-label">Foto <span class="text-red">*</span></label>
									<div class="col-sm-6">
										<input type="file" class="form-control" name="foto" id="foto" required/>
										<small>Max file size 5MB</small>
									</div>
								</div>
								
								<div class="form-group">
									<label for="nama" class="col-sm-2 control-label">Nama <span class="text-red">*</span></label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="nomor_telepon" class="col-sm-2 control-label">Nomor Telepon <span class="text-red">*</span></label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon" required/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Email <span class="text-red">*</span></label>
									<div class="col-sm-6">
										<input type="email" class="form-control" name="email" id="email" placeholder="Email" required/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Password <span class="text-red">*</span></label>
									<div class="col-sm-6">
										<input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="Alamat" class="col-sm-2 control-label">Alamat <span class="text-red">*</span></label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin <span class="text-red">*</span></label>
									<div class="col-sm-6">
										<select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
											<option value='laki-laki'>Laki-laki</option>
											<option value='perempuan'>Perempuan</option>
										</select>
									</div>
								</div>
								
								<hr>
								<?php
								$query = "SELECT * FROM `kriteria`";
								$result = $mysqli->query($query);
								?>
								
								<?php if ($result->num_rows > 0): ?>
									<?php while ($row = $result->fetch_assoc()): $row = (object)$row; ?>
										
										<div class="form-group">
											<label for="jenis_kelamin" class="col-sm-2 control-label"><?php echo $row->kriteria; ?> <span class="text-red">*</span></label>
											<div class="col-sm-6">
												<?php
												// tipe pilihan
												if ($row->tipe == 'Option'):
													$sub_query = "SELECT * FROM `sub_kriteria` WHERE id_kriteria = $row->id_kriteria";
													$sub_result = $mysqli->query($sub_query);
													?>
													<select class="form-control" name="sub_kriteria[<?php echo $row->id_kriteria; ?>]" id="<?php echo $row->kriteria; ?>">
														<?php while ($xrow = $sub_result->fetch_assoc()): $xrow = (object)$xrow; ?>
															<option value='<?php echo $xrow->id_sub_kriteria; ?>'><?php echo $xrow->sub_kriteria ?></option>
														<?php endwhile; ?>
													</select>
												
												<?php
												//tipe numerik
												else: ?>
													<input type="number" class="form-control" name="sub_kriteria[<?php echo $row->id_kriteria; ?>]" id="<?php echo $row->kriteria; ?>">
												<?php endif; ?>
											</div>
										</div>
									
									<?php endwhile; ?>
								<?php endif; ?>
							</div><!-- /.box-body -->
							
							<div class="box-footer row">
								<div class="col-sm-6 col-sm-offset-2">
									<button type="reset" class="btn btn-warning">Reset</button>
									<a type="button" class="btn btn-danger" href="karyawan.php">Cancel</a>
									<button type="submit" class="btn btn-success pull-right">Proses</button>
								</div>
							</div><!-- /.box-footer -->
						
						</div>
					</div><!-- row -->
				</form>
			
			</div><!-- /.box -->
		</section><!-- /.content -->
	
	</div><!-- /.content-wrapper -->
	
	<footer class="main-footer">
		<?php include 'layout/footer.php'; ?>
	</footer> <!-- /.footer -->

</div><!-- ./wrapper -->

<?php include 'layout/plugin.php'; ?>
<!-- CUSTOMIZE JAVASCRIPT -->

<script>
	$(function () {
		$('.datepicker').datepicker({
			autoclose: true,
			endDate: '<?php echo date('Y-m-d');?>',
			format: 'yyyy-mm-dd'
		});
		
		setTimeout(function () {
			$('button[type=reset]').click();
		}, 100)
	});
</script>
</body>
</html>
