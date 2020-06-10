<?php
session_start();
include 'dbconf.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
$menu = 'kriteria';
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'layout/head.php'; ?>
</head>
<body class="hold-transition fixed skin-green sidebar-mini">

<div class="wrapper">
	
	<header class="main-header">
		<?php include 'layout/header.php'; ?>
	</header> <!-- /.header -->
	
	<aside class="main-sidebar">
		<?php include 'layout/sidebar.php'; ?>
	</aside> <!-- /.sidebar -->
	
	<div class="content-wrapper">
		<section class="content-header">
			<h1 class="text-success">Kriteria</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard-ui.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="kriteria.php">Data Kriteria</a></li>
			</ol>
		</section><!-- /.content-header -->
		
		<section class="content">
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title text-success"><i class="fa fa-book"> </i> Data Kriteria</h3>
				</div><!-- box-header-->
				
				<div class="box-body">
					<div class="row">
						<div class="col-lg-12 col-xs-12">
							<table id="maintable" class="table table-responsive table-bordered table-hover">
								<thead>
								<tr>
									<th width="20px">No.</th>
									<th>Kriteria</th>
									<th>Cost / Benefit</th>
									<th>Pilihan Jawaban</th>
									<th>Bobot</th>
									<!--									<th width="50px;">Opsi</th>-->
								</tr>
								</thead>
								<tbody>
								<?php
								$query = "SELECT * FROM kriteria INNER JOIN sub_kriteria ON kriteria.id_kriteria = sub_kriteria.id_kriteria ORDER BY kriteria.id_kriteria ASC, sub_kriteria.bobot ASC";
								$run = $mysqli->query($query);
								$no = 0;
								$id_kriteria = 0;
								if ($run->num_rows != 0):
									while ($row = $run->fetch_assoc()) {
										$row = (object)$row;
										if ($row->id_kriteria != $id_kriteria) {
											$no++;
											$id_kriteria = $row->id_kriteria;
										}
										?>
										
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $row->kriteria; ?></td>
											<td>
												<?php if ($row->cost_benefit): ?>
													<small class='label label-success'>Benefit</small>
												<?php else: ?>
													<small class='label label-warning'>Cost</small>
												<?php endif; ?>
											</td>
											<td><?php echo $row->sub_kriteria; ?></td>
											<td><?php echo $row->bobot; ?></td>
											<!--											<td class="text-center">-->
											<!--												<a href="edit-kriteria.php?id=--><?php //echo $row->id_kriteria ?><!--" class="fa fa-edit btn btn-info btn-sm"></a>-->
											<!--											</td>-->
										</tr><!-- row -->
									
									<?php } endif; ?>
								</tbody>
							</table>
						</div>
					</div>
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

<script>
	$(document).ready(function () {
		$('#maintable').DataTable({
			language: {
				url: "assets/Indonesian-Alternative.json"
			},
			ordering: false,
			columns: [
				{
					name: 'no',
					title: 'No'
				},
				{
					name: 'kriteria',
					title: 'Kriteria'
				},
				{
					name: 'cost_benefit',
					title: 'Cost / Benefit'
				},
				{
					title: 'Pilihan Jawaban'
				},
				{
					title: 'Bobot'
				},
				// {
				// 	name: 'opsi',
				// 	title: 'Opsi'
				// },
			],
			rowsGroup: [
				'no:name',
				'kriteria:name',
				'cost_benefit:name',
				// 'opsi:name',
			],
			lengthMenu: [[-1, 10, 25, 50], ["All", 10, 25, 50]]
		});
	});
</script>
</body>
</html>
