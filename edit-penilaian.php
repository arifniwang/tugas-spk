<?php
session_start();
include 'dbconf.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
$menu = 'user';
$id = $_GET['id'];

$result = $mysqli->query("SELECT *  FROM `karyawan` WHERE `id_karyawan` = " . $id);
$karyawan = $result->fetch_assoc();
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
			<h1 class="text-success">Penilaian</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard-ui.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="penilaian.php">Data Penilaian</a></li>
				<li><a href="edit-penilaian.php">Edit Penilaian</a></li>
			</ol>
		</section><!-- /.content-header -->
		
		<!-- Main content -->
		<section class="content">
			
			<!-- Default box -->
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title text-success"><i class="fa fa-list"> </i> Edit Data Penilaian</h3>
				</div><!-- box-header-->
				
				<!-- form start -->
				<form class="form-horizontal" enctype="multipart/form-data" method="post" action="proses-edit-penilaian.php?id=<?php echo $_GET['id']; ?>">
					<div class="row">
						<div class="col-xs-12">
							<?php
							$sql = "SELECT
								`nilai`.`id_nilai`,`kriteria`.`kriteria`,`nilai`.`value`,`nilai`.`nilai`
								FROM `nilai`
								JOIN `kriteria` ON `kriteria`.`id_kriteria` = `nilai`.`id_kriteria`
								WHERE `nilai`.`id_karyawan` = " . $id;
							$data = $mysqli->query($sql);
							?>
							<div class="box-body">
								<div class="form-group">
									<label for="nama" class="col-sm-2">Nama</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $karyawan['nama']; ?>" placeholder="Nama" required readonly=""/>
									</div>
								</div>
								
								<?php if ($data->num_rows > 0): $no = 1; ?>
									<?php while ($row = $data->fetch_assoc()): ?>
										<div class="form-group">
											<label for="k1" class="col-sm-2">K<?php echo $no ?> (<?php echo $row['kriteria']?>)</label>
											<div class="col-sm-6">
												<input type="number" min="1" max="100" class="form-control" name="nilai[<?php echo $row['id_nilai'] ?>]" id="k<?php echo $no; ?>" required
												       placeholder="Bobot <?php echo $no++; ?>" value="<?php echo $row['nilai']; ?>">
											</div>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div><!-- /.box-body -->
							
							<div class="box-footer row">
								<div class="col-sm-6 col-sm-offset-2">
									<button type="reset" class="btn btn-warning">Reset</button>
									<a type="button" class="btn btn-danger" href="penilaian.php">Cancel</a>
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
	
	});
</script>
</body>
</html>
