<?php
session_start();
$_SESSION['judul'] = 'Energi Bangsa';
$_SESSION['desc'] = 'SPK Pengangkatan Karyawan';
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'layout/head.php'; ?>
	<link rel="stylesheet" href="assets/landingpage.css">
</head>
<body>


<div class="site-wrapper">
	<div class="site-wrapper-inner">
		<div class="cover-container">
			<div class="masthead clearfix">
				<div class="inner">
					<h3 class="masthead-brand" style="color: #FFFFFF;">Energi Bangsa</h3>
					<nav>
						<ul class="nav masthead-nav">
							<?php if (isset($_SESSION['login'])): ?>
								<?php if ($_SESSION['level'] == 'karyawan'): ?>
									<li><a href="dashboard-ui.php">Profile</a></li>
								<?php else: ?>
									<li><a href="dashboard-ui.php">Dashboard</a></li>
								<?php endif; ?>
							<?php else: ?>
								<li><a href="login-ui.php">Login</a></li>
								<li><a href="registrasi.php">Register</a></li>
							<?php endif; ?>
						</ul>
					</nav>
				</div>
			</div>
			
			<div class="inner cover">
				<h1 class="cover-heading">Selamat Datang.</h1>
				<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad architecto assumenda delectus distinctio error laborum magnam quo repellendus voluptas. Cupiditate dolor excepturi inventore praesentium repudiandae. Beatae doloribus id sit ullam.</p>
			</div>
			
			<div class="mastfoot">
				<div class="inner">
					<p>Copyright © 2020 Hisom Mukhlasin. All rights reserved.</p>
				</div>
			</div>
		
		</div>
	
	</div>

</div>

<?php include 'layout/plugin.php'; ?>
</body>
</html>