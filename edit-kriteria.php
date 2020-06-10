<?php
session_start();
include 'dbconf.php';
if (!isset($_SESSION['login'])) {
	header('Location: login-ui.php');
}
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
				<li><a href="kriteria.php">Edit Kriteria</a></li>
			</ol>
		</section><!-- /.content-header -->
		
		<section class="content">
			
			<!-- Default box -->
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title text-success"><i class="fa fa-book"> </i> Edit Kriteria</h3>
				</div><!-- box-header-->
				
				<form class="form-horizontal" enctype="multipart/form-data" method="post" action="proses-edit-kriteria.php?id=<?php echo $_GET['id']; ?>">
					<div class="row">
						<div class="col-lg-10 col-xs-12">
							<div class="box-body">
								<?php
								$id = $_GET['id'];
								$query = "SELECT *  FROM `kriteria` WHERE `id_kriteria` = $id";
								$result = $mysqli->query($query);
								$data = (object)$result->fetch_assoc();
								?>
								<div class="form-group">
									<label for="kriteria" class="col-sm-3 control-label">Kriteria <span class="text-danger" title="This field is required">*</span></label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="kriteria" id="kriteria" value="<?php echo $data->kriteria; ?>" placeholder="Kriteria" required/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="cost_benefit" class="col-sm-3 control-label">Cost / Benefit <span class="text-danger" title="This field is required">*</span></label>
									<div class="col-sm-9">
										<select class="form-control" name="cost_benefit" id="cost_benefit">
											<option value='cost' <?php if ($data->cost_benefit == 'cost') echo "selected" ?> >Cost</option>
											<option value='benefit' <?php if ($data->cost_benefit == 'benefit') echo "selected" ?> >Benefit</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label for="tipe" class="col-sm-3 control-label">Tipe <span class="text-danger" title="This field is required">*</span></label>
									<div class="col-sm-9">
										<select class="form-control" name="tipe" id="tipe">
											<option value='Numeric' <?php if ($data->tipe == 'Numeric') echo "selected" ?> >Numerik</option>
											<option value='Option' <?php if ($data->tipe == 'Option') echo "selected" ?> >Pilihan Jawaban</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label for="tipe" class="col-sm-3 control-label">Limit</label>
									<div class="col-sm-9">
										<div class="radio">
											<label><input type="radio" name="limit" <?php if ($data->limit == 1) echo "checked" ?> >Ya</label>
										</div>
										<div class="radio">
											<label><input type="radio" name="limit" <?php if ($data->limit != 1) echo "checked" ?> >Tidak</label>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-3 text-right">
										Pilihan Jawaban <span class="text-danger" title="This field is required">*</span>
									</label>
									<div class="col-sm-9">
										<div class="box box-success no-padding no-margin">
											<div class="box-body">
												
												<?php
												//default data
												$query = "SELECT *  FROM `sub_kriteria` WHERE `id_kriteria` = $id AND `min` = 0 AND `max` = 0 AND BOBOT = 0";
												$defaut = (object) $mysqli->query($query);
												
												$query = "SELECT *  FROM `sub_kriteria` WHERE `id_kriteria` = $id";
												$result = $mysqli->query($query);
												?>
												<div id="formNumeric" class="form-group row">
													<div class="col-sm-12">
														<table class="table table-bordered table-child table-hover">
															<thead>
															<tr>
																<th>Bobot</th>
																<th>Min</th>
																<th>Max</th>
																<th style="width: 100px;text-align: center;">Action</th>
															</tr>
															<tr>
																<th>
																	<input type="text" id="bobot" class="form-control">
																</th>
																<th>
																	<input type="number" id="min" class="form-control">
																</th>
																<th>
																	<input type="number" id="max" class="form-control">
																</th>
																<th>
																	<div class="button_action text-center">
																		<a class="btn btn-sm btn-success btn-add-child btn-add-checklist" title="Delete" href="javascript:void(0)">
																			Add
																		</a>
																		<a class="btn btn-sm btn-info btn-save-child" title="Delete" href="javascript:void(0)" style="display: none;">
																			Save
																		</a>
																	</div>
																</th>
															</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							
							<div class="box-footer">
								<a type="button" class="btn btn-sm btn-danger" href="kriteria.php">Cancel</a>
								<button type="submit" class="btn btn-sm btn-success pull-right">Update</button>
							</div>
							<!-- /.box-footer -->
						</div>
					</div><!-- row -->
				</form>
			</div>
			<!-- /.box -->
		
		</section>
		<!-- /.content -->
	</div><!-- /.content-wrapper -->
	
	<footer class="main-footer">
		<?php include 'layout/footer.php'; ?>
	</footer> <!-- /.footer -->
</div><!-- ./wrapper -->

<?php include 'layout/plugin.php'; ?>
<script>
	$(function () {
		//Date picker
		$('#datepicker').datepicker({
			autoclose: true
		});
	});
</script>
</body>
</html>
