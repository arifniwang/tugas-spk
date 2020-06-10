<?php
session_start();
include 'dbconf.php';
include 'lhast.php';
require_once 'helper/NiwangHelper.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
date_default_timezone_set('Asia/Jakarta');
$helper = new NiwangHelper();

$user = $_POST['user'];
$pass = $_POST['pass'];
$level = 'admin';
$since = date('Y-m-d');
$foto = $helper->uploadImage('foto');
$foto = ($foto == '' ? '-' : $foto);

//validasi email
$sql = 'SELECT COUNT(*) as total FROM `user` WHERE `user` = "' . $user . '" ';
$check_email = $mysqli->query($sql)->fetch_assoc()['total'];
if ($check_email > 0) {
	header('Location: add-user.php?message=Username sudah digunakan');
	exit();
}

$sql = "INSERT INTO `user` (`id`, `user`, `pass`, `level`, `since`, `foto`) VALUES
	(NULL, '" . $user . "', '" . md5($pass) . "', '" . $level . "', '" . $since . "', '" . $foto . "')";
$result = $mysqli->query($sql);
header('Location: user.php?message=Data berhasil di tambahkan');
?>