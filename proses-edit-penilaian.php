<?php
session_start();
include 'dbconf.php';
require_once 'helper/NiwangHelper.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
date_default_timezone_set('Asia/Jakarta');
$helper = new NiwangHelper();
$id = $_GET['id'];

//data karyawan
$sql = "SELECT * FROM karyawan WHERE id_karyawan = " . $id;
$data = (object)$mysqli->query($sql)->fetch_assoc();
$nilai = $_POST['nilai'];
foreach ($nilai as $id_nilai => $nilai) {
	$sql = 'UPDATE `nilai` set `nilai` = ' . $nilai . ' WHERE `id_nilai` = ' . $id_nilai;
	$mysqli->query($sql);
}

header('Location: penilaian.php?message=Data berhasil disimpan');
?>