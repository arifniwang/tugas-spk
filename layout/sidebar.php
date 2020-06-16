<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left">
			<img src="<?php echo $_SESSION['foto']; ?>" class="img-circle" alt="User Image" height="50px" width="50px">
		</div>
		<div class="pull-left info">
			<p><?php echo ucwords($_SESSION['user']); ?></p>
			<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	</div>
	<!-- /.search form -->
	
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
		<li class="header">MAIN NAVIGATION</li>
		<li <?php if ($menu == 'dashboard'): ?> class="active" <?php endif; ?> >
			<a href="dashboard-ui.php">
				<i class="fa fa-windows"></i> <span>Dashboard</span>
			</a>
		</li>
		
		<?php if ($_SESSION['level'] == 'admin') { ?>
			<li <?php if ($menu == 'hasil'): ?> class="active" <?php endif; ?> >
				<a href="hasil.php">
					<i class="fa fa-laptop"></i> <span>Hasil Perhitungan</span>
				</a>
			</li>
			<li <?php if ($menu == 'kriteria'): ?> class="active" <?php endif; ?> >
				<a href="kriteria.php">
					<i class="fa fa-book"></i> <span>Data Kriteria</span>
				</a>
			</li>
			<li <?php if ($menu == 'karyawan'): ?> class="active" <?php endif; ?> >
				<a href="karyawan.php">
					<i class="fa fa-users"></i> <span>Data Karyawan</span>
				</a>
			</li>
			<li <?php if ($menu == 'user'): ?> class="active" <?php endif; ?> >
				<a href="user.php">
					<i class="fa fa-user"></i> <span>Data User</span>
				</a>
			</li>
		<?php } else { ?>
			<li <?php if ($menu == 'karyawan'): ?> class="active" <?php endif; ?> >
				<a href="edit-karyawan.php?id=<?php echo $_SESSION['id'] ?>">
					<i class="fa fa-pencil"></i> <span>Lengkapi Data</span>
				</a>
			</li>
		<?php } ?>
	</ul>
</section>
<!-- /.sidebar -->