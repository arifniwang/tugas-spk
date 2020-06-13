<?php
@session_start();
$mysqli = new mysqli("localhost", "root", "root", "ptatm");
/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
$_SESSION['creator'] = 'Hisom Mukhlisin';
$_SESSION['judul'] = 'Energi Bangsa';
$_SESSION['desc'] = 'SPK Pengangkatan Karyawan';
