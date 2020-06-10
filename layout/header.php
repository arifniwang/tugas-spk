<!-- Logo -->
<a href="#" class="logo">
	<!-- mini logo for sidebar mini 50x50 pixels -->
	<span class="logo-mini"><b><?php echo $_SESSION['judul']; ?></b></span>
	<!-- logo for regular state and mobile devices -->
	<span class="logo-lg"><b><?php echo $_SESSION['judul']; ?></b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>
	
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<!-- User Account: style can be found in dropdown.less -->
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="<?php echo $_SESSION['foto']; ?>" class="user-image" alt="User Image">
					<span class="hidden-xs"><?php echo ucwords($_SESSION['user']); ?></span>
				</a>
				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header">
						<img src="<?php echo $_SESSION['foto']; ?>" class="img-circle" alt="User Image">
						
						<p>
							<?php
							echo ucwords($_SESSION['user']); ?> - <?php echo ucwords($_SESSION['level']);
							$date = date_create($_SESSION['since']);
							?>
							<small>Member Since, <?php echo date_format($date, 'd M Y'); ?></small>
						</p>
					</li>
					
					<!-- Menu Footer-->
					<li class="user-footer">
						<div class="pull-left">
							<!--a href="#" class="btn btn-default btn-flat">Profile</a-->
						</div>
						<div class="pull-right">
							<a href="logout.php" class="btn btn-default btn-flat">Logout</a>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>