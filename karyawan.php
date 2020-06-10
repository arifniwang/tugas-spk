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
			</ol>
		</section><!-- /.content-header -->
		
		<section class="content">
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title text-success"><i class="fa fa-users"> </i> Data Karyawan</h3>
				</div><!-- box-header-->
				
				<div class="box-body">
					<div class="row">
						<div class="col-lg-12 col-xs-12">
							<a href="add-karyawan.php" class="pull-right btn btn-sm btn-success">Tambah Karyawan</a>
							<table id="maintable" class="table table-responsive table-bordered table-striped table-hover">
								<thead>
								<tr>
									<th width="15px">No.</th>
									<th>Foto</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Nomor Telepon</th>
									<th>Opsi</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$result = $mysqli->query("select * from karyawan");
								$i = 1;
								if ($result->num_rows != 0) {
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td>" . $i . ".</td>";
										echo "<td><a class='fancybox-effects-d' href='./" . $row['foto'] . "' title='" . $row['nama'] . "'>
										<img src='./" . $row['foto'] . "' height=35 /></a></td>";
										echo "<td>" . ucwords($row['nama']) . "</td>";
										echo "<td><a href='mailto:" . $row['email'] . "' target='_blank'>" . $row['email'] . "</a></td>";
										echo "<td><a href='tel:" . $row['nomor_telepon'] . "' target='_blank'>" . ucwords($row['nomor_telepon']) . "</a></td>";
										echo '<td><div class="btn-group">';
										echo '<a href="edit-karyawan.php?id=' . $row['id_karyawan'] . '" class="fa fa-edit btn btn-info btn-sm"></a>'; ?>
										<a href="delete-karyawan.php?id=<?php echo $row['id_karyawan']; ?>" onClick="return confirm('Hapus Data Karyawan <?php echo $row['nama']; ?>  ?');"
										   class="fa fa-close btn btn-danger btn-sm"></a>
										<?php
										echo '</div></td>';
										echo "</tr>";
										$i++;
									}
								}
								?>
								</tbody>
							</table>
						</div>
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

<!-- DataTables -->
<script type="text/javascript" language="javascript" src="assets/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="assets/buttons.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="assets/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="assets/buttons.print.min.js"></script>

<script>
	$(document).ready(function () {
		$('#maintable').DataTable({
			"language": {
				"url": "assets/Indonesian-Alternative.json"
			},
			ordering: false,
			dom: 'Bfrtip',
			buttons: [
				'print'
			]
		});
	});
</script>
</body>
</html>
