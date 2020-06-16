<?php
include 'dbconf.php';
$id_karyawan = isset($_GET['key']) ? base64_decode($_GET['key']) : header('Location: login-ui.php?message=Page not found');

$sql = "UPDATE `karyawan` SET
`status` = 'Aktif'
WHERE `id_karyawan` = " . $id_karyawan;
$mysqli->query($sql);

header('Location: login-ui.php?message=Akun anda berhasil di aktivasi')
?>


