<?php
session_start();
include 'dbconf.php';
include 'lhast.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');

$result = $mysqli->query("DELETE FROM `nilai` WHERE `id_karyawan` = " . $_GET['id']);
$result = $mysqli->query("DELETE FROM `karyawan` WHERE `id_karyawan` = " . $_GET['id']);
if (!$result) {
	header('Location: karyawan.php?message=' . $mysqli->connect_errno . " - " . $mysqli->connect_error);
	exit();
} else {
	header('Location: karyawan.php?message=Data berhasil dihapus');
}
?>