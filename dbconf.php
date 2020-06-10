<?php
	@session_start();
	$mysqli = new mysqli("localhost", "root", "root", "ptatm");
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$_SESSION['creator'] = 'Desi Arissandi';	// nama developer
	$_SESSION['judul'] = 'PT ATM';	// nama aplikasi
	$_SESSION['desc'] = 'SPK Pengangkatan Karyawan Tetap';	// deskripsi aplikasi
