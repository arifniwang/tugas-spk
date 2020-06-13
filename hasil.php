<?php
session_start();
include 'dbconf.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
$menu = 'hasil';

//data karyawan
$karyawan = [];
$sql = "SELECT * FROM `karyawan` WHERE `status` = 'Aktif'";
$data_karyawan = $mysqli->query($sql);
while ($row = $data_karyawan->fetch_assoc()) {
	$karyawan[] = $row;
}

$pemenang = '';
$nilai_pemenang = 0;
$list_min = [];
$list_max = [];
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'layout/head.php'; ?>
	<style>
		hr {
			margin-top: 25px;
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
			<h1 class="text-success">Hasil</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard-ui.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="user.php">Data Hasil</a></li>
			</ol>
		</section><!-- /.content-header -->
		
		<section class="content">
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title text-success"><i class="fa fa-list"> </i> Hasil Perhitungan</h3>
				</div><!-- box-header-->
				
				<div class="box-body">
					<div class="text-right">
						<button class="btn btn-success btn-sm" onclick="myFunction()">Print</button>
					</div>
					
					<!--Data Kriteria-->
					<p class="text-center"><b>Data Kriteria </b></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>Alternatif / Kriteria</th>
							<?php
							$no = 1;
							$kriteria = [];
							//data kriteria
							$cluster = $mysqli->query("SELECT * FROM `kriteria`");
							if ($cluster->num_rows > 0) {
								while ($row = $cluster->fetch_assoc()) {
									$kriteria[] = $row;
									echo "<th>" . $row['kriteria'] . "</th>";
								}
							};
							?>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td style="text-align: center;vertical-align: middle;"><b>Cost / Benefit</b></td>
							<?php
							foreach ($kriteria as $key => $row) {
								echo "<td>" . ucfirst($row['cost_benefit']) . " (" . $row['bobot'] . ")" . "</td>";
							}
							?>
						</tr>
						
						<?php
						$rowspan = 0;
						foreach ($kriteria as $key => $row) {
							$sql = 'SELECT * FROM sub_kriteria WHERE `id_kriteria` = ' . $row['id_kriteria'] . ' ORDER BY `bobot` ASC';
							$sub_kriteria = $mysqli->query($sql);
							$num = $sub_kriteria->num_rows;
							$rowspan = ($num > $sub_kriteria->num_rows ? $num : $sub_kriteria->num_rows);
							
							while ($xrow = $sub_kriteria->fetch_assoc()) {
								$kriteria[$key]['sub'][] = $xrow;
							}
						}
						?>
						
						<?php for ($i = 0; $i < $rowspan; $i++): ?>
							<tr>
								<?php if ($i === 0): ?>
									<td rowspan="<?php echo $rowspan; ?>" style="text-align: center;vertical-align: middle;"><b>Bobot</b></td>
								<?php endif; ?>
								
								<?php
								foreach ($kriteria as $key => $row) {
									if (isset($row['sub'][$i])) {
										echo "<td>" . $row['sub'][$i]['sub_kriteria'] . " (" . $row['sub'][$i]['bobot'] . ")</td>";
									} else {
										echo "<td></td>";
									}
								}
								?>
							</tr>
						<?php endfor; ?>
						</tbody>
					</table><!--./ Data Kriteria-->
					
					
					<!--Matrix Alternatif - Kriteria-->
					<hr>
					<p class="text-center"><b>Matrix Alternatif - Kriteria</b></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>Karyawan</th>
							<?php
							$no = 1;
							foreach ($kriteria as $key => $row) {
								echo "<th>" . $row['kriteria'] . "</th>";
							} ?>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach ($karyawan as $key => $row) {
							$sql = 'SELECT `nilai`.* FROM `nilai` JOIN `kriteria` ON `kriteria`.`id_kriteria` = `nilai`.`id_kriteria` WHERE `id_karyawan` = ' . $row['id_karyawan'];
							$data_nilai = $mysqli->query($sql);
							$nilai = [];
							if ($data_nilai->num_rows > 0) {
								while ($row = $data_nilai->fetch_assoc()) {
									$nilai[] = $row;
								}
							};
							$karyawan[$key]['nilai'] = $nilai;
						}
						?>
						
						<?php foreach ($karyawan as $key => $row): ?>
							<tr>
								<td><b><?php echo $row['nama'] ?></b></td>
								<?php
								foreach ($row['nilai'] as $xkey => $xrow) {
									echo "<td>" . ($xrow['bobot_sub'] * 100) . "</td>";
								}
								?>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table><!--./ Matrix Alternatif - Kriteria-->
					
					
					<!--Nilai Min - Max tiap Kriteria-->
					<hr>
					<p class="text-center"><b>Nilai Min - Max tiap Kriteria</b></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>Kriteria</th>
							<?php
							$no = 1;
							foreach ($kriteria as $key => $row) {
								echo "<th>" . $row['kriteria'] . "</th>";
							} ?>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td><b>Nilai Minimal</b></td>
							<?php foreach ($kriteria as $key => $row) {
								$sql = "SELECT MIN(`bobot_sub`) as min FROM `nilai` JOIN `karyawan` on `karyawan`.`id_karyawan` = `nilai`.`id_karyawan`
								WHERE `nilai`.`id_kriteria` = " . $row['id_kriteria'] . " AND `karyawan`.`status` = 'Aktif'";
								$min = $mysqli->query($sql)->fetch_assoc()['min'];
								$kriteria[$key]['min'] = $min;
								echo "<td>" . ($min * 100) . "</td>";
							} ?>
						</tr>
						<tr>
							<td><b>Nilai Maximal</b></td>
							<?php foreach ($kriteria as $key => $row) {
								$sql = "SELECT MAX(`bobot_sub`) as max FROM `nilai` JOIN `karyawan` on `karyawan`.`id_karyawan` = `nilai`.`id_karyawan`
								WHERE `nilai`.`id_kriteria` = " . $row['id_kriteria'] . " AND `karyawan`.`status` = 'Aktif'";
								$max = $mysqli->query($sql)->fetch_assoc()['max'];
								$kriteria[$key]['max'] = $max;
								echo "<td>" . ($max * 100) . "</td>";
							} ?>
						</tr>
						</tbody>
					</table><!--./ Nilai Min - Max tiap Kriteria-->
					
					
					<!--Matrix Ternormalisasi-->
					<hr>
					<p class="text-center"><b>Matrix Ternormalisasi</b></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>Karyawan</th>
							<?php
							$no = 1;
							foreach ($kriteria as $key => $row) {
								echo "<th>" . $row['kriteria'] . "</th>";
							}
							?>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($karyawan as $key => $row): ?>
							<tr>
								<td><b><?php echo $row['nama'] ?></b></td>
								<?php
								foreach ($row['nilai'] as $xkey => $xrow) {
									$cost_benefit = '';
									$nilai = $xrow['bobot_sub'] * 100;
									$min = 0;
									$max = 0;
									
									//find min max and cost or benefit
									foreach ($kriteria as $yrow) {
										if ($yrow['id_kriteria'] == $xrow['id_kriteria']) {
											$cost_benefit = $yrow['cost_benefit'];
											$min = $yrow['min'] * 100;
											$max = $yrow['max'] * 100;
										}
									}
									
									//calculate
									if ($cost_benefit === 'benefit') {
										$nilai = $nilai / $max;
									} else {
										$nilai = $nilai / $min;
									}
									$karyawan[$key]['nilai'][$xkey]['normalisasi'] = $nilai;
									echo "<td>" . round($nilai, 4) . "</td>";
								}
								?>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table><!--./ Matrix Ternormalisasi-->
					
					
					<!--Matrix Terbobot-->
					<hr>
					<p class="text-center"><b>Matrix Terbobot</b></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th>Karyawan</th>
							<?php
							$no = 1;
							foreach ($kriteria as $key => $row) {
								echo "<th>" . $row['kriteria'] . "</th>";
							}
							?>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($karyawan as $key => $row): ?>
							<tr>
								<td><b><?php echo $row['nama'] ?></b></td>
								<?php
								$hasil_akhir = 0;
								foreach ($row['nilai'] as $xkey => $xrow) {
									//calculate bobot
									$bobot = $xrow['bobot'] * $xrow['normalisasi'];
									$bobot = round($bobot, 4);
									$hasil_akhir += $bobot;
									echo "<td>" . $bobot . "</td>";
								}
								$karyawan[$key]['hasil_akhir'] = $hasil_akhir;
								
								//update nilai
								$sql = "UPDATE `karyawan` SET `nilai` = '" . $hasil_akhir . "' WHERE `id_karyawan` = " . $row['id_karyawan'];
								$mysqli->query($sql);
								
								//find pemenang
								if ($nilai_pemenang < $hasil_akhir) {
									$nilai_pemenang = $hasil_akhir;
									$pemenang = $row['nama'];
								}
								?>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table><!--./ Matrix Terbobot-->
					
					
					<!--Hasil Akhir-->
					<hr>
					<p class="text-center"><b>Hasil Akhir</b></p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th width="50%">Karyawan</th>
							<th>Hasil Akhir</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($karyawan as $key => $row): ?>
							<tr>
								<td><b><?php echo $row['nama'] ?></b></td>
								<td><?php echo $row['hasil_akhir']; ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table><!--./ Hasil Akhir-->
					
					
					<!--Hasil Analisa-->
					<hr>
					<p class="text-center"><b>Hasil Analisa</b></p>
					<p class="text-center">
						Hasil analisa diurutkan berdasarkan hasil nilai tertinggi.<br>
						Dapat disimpulkan bahwa Alternatif Karyawan terbaik untuk diangkat sebagai pegawai tetap adalah
						<b><?php echo $pemenang; ?></b> dengan nilai <b><?php echo $nilai_pemenang; ?></b>.
					</p>
					<table class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th width="5%">No</th>
							<th width="45%">Karyawan</th>
							<th>Hasil Akhir</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$sql = 'SELECT * FROM `karyawan` WHERE `status` = "Aktif" ORDER BY `nilai` DESC';
						$sort = $mysqli->query($sql);
						foreach ($sort as $key => $row): ?>
							<tr>
								<td><?php echo($key + 1) ?>.</td>
								<td><b><?php echo $row['nama'] ?></b></td>
								<td><?php echo $row['nilai']; ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table><!--./ Hasil Analisa-->
				
				
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
		$('#example2').DataTable({
			"language": {
				"url": "assets/Indonesian-Alternative.json"
			},
			<?php if($_SESSION['level'] == 'admin'){?>
			dom: 'Bfrtip',
			buttons: [
				'copy', 'excel', 'pdf', 'print', 'colvis'
			]<?php } ?>
		});
	});
</script>
<script>
	function myFunction() {
		window.print();
	}
</script>
</body>
</html>
