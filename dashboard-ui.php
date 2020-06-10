<?php
session_start();
include 'dbconf.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
$menu = 'dashboard';
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'layout/head.php'; ?>
	<style>
		.lead {
			text-align: justify;
		}
	</style>
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
			<h1 class="text-success">Dashboard</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard-ui.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			</ol>
		</section><!-- /.content-header -->
		
		<section class="content">
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title text-success"><i class="fa fa-windows"> </i> Dashboard</h3>
				</div><!-- box-header-->
				
				<div class="box-body">
					<div class="row">
						
						<?php if ($_SESSION['level'] == 'admin'): ?>
							<div class="col-lg-3 col-md-3 col-xs-12">
								<div class="small-box bg-red">
									<div class="inner">
										<h3>
											<font color="white">
												<?php
												$result = $mysqli->query("select * from karyawan");
												echo $result->num_rows;
												?>
											</font>
										</h3>
										<p>Jumlah Karyawan</p>
									</div>
									<div class="icon">
										<i class="fa fa-users"></i>
									</div>
									<?php
									if ($_SESSION['level'] == 'admin'): ?>
										<a href="karyawan.php" class="small-box-footer">
											Detail <i class="fa fa-arrow-circle-right"></i>
										</a>
									<?php endif; ?>
								</div>
							</div><!-- ./col -->
							
							<div class="col-lg-3 col-md-3 col-xs-12">
								<!-- small box -->
								<div class="small-box bg-yellow">
									<div class="inner">
										<h3>
											<font color="white">
												<?php
												$result = $mysqli->query("select * from kriteria");
												echo $result->num_rows;
												?>
											</font>
										</h3>
										<p>Jumlah Kriteria</p>
									</div>
									<div class="icon">
										<i class="fa fa-book"></i>
									</div>
									<?php if ($_SESSION['level'] == 'admin'): ?><a href="kriteria.php" class="small-box-footer">
										Detail <i class="fa fa-arrow-circle-right"></i>
									</a>
									<?php endif; ?>
								</div>
							</div><!-- ./col -->
							
							<div class="col-lg-3 col-md-3 col-xs-12">
								<!-- small box -->
								<div class="small-box bg-blue">
									<div class="inner">
										<h3>
											<font color="white">
												<?php
												$result = $mysqli->query("select * from user");
												echo $result->num_rows;
												?>
											</font>
										</h3>
										<p>Jumlah User</p>
									</div>
									<div class="icon">
										<i class="fa fa-user"></i>
									</div>
									<?php
									if ($_SESSION['level'] == 'admin'): ?>
										<a href="user.php" class="small-box-footer">
											Detail <i class="fa fa-arrow-circle-right"></i>
										</a>
									<?php endif; ?>
								</div>
							</div><!-- ./col -->
						
						<?php else: ?>
							
							<div class="container">
								<h1>SELAMAT DATANG </h1>
								<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque culpa distinctio eaque, incidunt ipsa laudantium nostrum officia omnis
									optio quisquam similique, voluptatum! Architecto cupiditate libero molestiae quidem rerum vero voluptatem!</p>
							</div>
						
						<?php endif; ?>
					
					</div><!-- row -->
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
	
	<footer class="main-footer">
		<?php include 'layout/footer.php'; ?>
	</footer> <!-- /.footer -->
</div><!-- ./wrapper -->

<?php include 'layout/plugin.php'; ?>
<!-- CUSTOMIZE JAVASCRIPT -->
</body>
</html>
