<?php
session_start();
include 'dbconf.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
$menu = 'penilaian';

//data karyawan
$sql = "SELECT * FROM `karyawan`";
$karyawan = $mysqli->query($sql);

function ket($input)
{
	if ($input == 0) return "<small class='label label-danger'>Belum Dinilai</small>";
	if ($input > 0 && $input <= 44) return "<small class='label label-warning'>Kurang</small>";
	if ($input >= 45 && $input <= 59) return "<small class='label label-info'>Cukup</small>";
	if ($input >= 60 && $input <= 79) return "<small class='label label-primary'>Baik</small>";
	if ($input >= 80 && $input <= 100) return "<small class='label label-success'>Sangat Baik</small>";
}
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
				<li><a href="user.php">Data Penilaian</a></li>
			</ol>
		</section><!-- /.content-header -->
		
		<section class="content">
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title text-success"><i class="fa fa-list"> </i> Data Penilaian</h3>
				</div><!-- box-header-->
				
				<div class="box-body">
					<div class="row">
						<div class="col-lg-12 col-xs-12">
							<table id="maintable" class="table table-responsive table-bordered table-striped table-hover">
								<thead>
								<tr>
									<th width="15px">No.</th>
									<th>Nama</th>
									<?php
									$no = 1;
									//data kriteria
									$cluster = $mysqli->query("SELECT * FROM `kriteria`");
									if ($cluster->num_rows > 0) {
										while ($cluster->fetch_assoc()) {
											echo "<th>K" . $no++ . "</th>";
										}
									}; ?>
									<th>Opsi</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$i = 1;
								if ($karyawan->num_rows != 0) {
									//data kriteria
									while ($row = $karyawan->fetch_assoc()) {
										$kriteria = $mysqli->query("SELECT * FROM `kriteria`");
										
										echo "<tr>";
										echo "<td>" . $i . ".</td>";
										echo "<td>" . ucwords($row['nama']) . "</td>";
										while ($xrow = $kriteria->fetch_assoc()) {
											$sql = "SELECT * FROM `nilai` WHERE `id_karyawan` = " . $row['id_karyawan'] . " AND `id_kriteria` = " . $xrow['id_kriteria'];
											$result = $mysqli->query($sql)->fetch_assoc();
											echo "<td>" . ket($result['nilai']) . "</td>";
										}
										echo '<td><div class="btn-group">';
										echo '<a href="edit-penilaian.php?id=' . $row['id_karyawan'] . '" class="fa fa-edit btn btn-info btn-sm"></a>'; ?>
										<?php
										echo '</div>
										  </td>';
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
