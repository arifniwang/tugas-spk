<?php
session_start();
include 'dbconf.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
$menu = 'user';
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
			<h1 class="text-success">User</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard-ui.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="karyawan.php">Data User</a></li>
				<li><a href="add-karyawan.php">Tambah Data</a></li>
			</ol>
		</section><!-- /.content-header -->
		
		<section class="content">
			<div class="box box-success">
				
				<div class="box-header with-border">
					<h3 class="box-title text-success"><i class="fa fa-user"> </i> Tambah Data User</h3>
				</div><!-- box-header-->
				
				<!-- form start -->
				<form class="form-horizontal" enctype="multipart/form-data" method="post" action="proses-user.php">
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
									<label for="user" class="col-sm-2 control-label">Username <span class="text-red">*</span></label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="user" id="user" placeholder="Username" required/>
									</div>
								</div>

								<div class="form-group">
									<label for="pass" class="col-sm-2 control-label">Password <span class="text-red">*</span></label>
									<div class="col-sm-6">
										<input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required/>
									</div>
								</div>
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
		}, 350)
	});
</script>
</body>
</html>
