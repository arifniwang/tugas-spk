<?php
session_start();
include 'dbconf.php';
require_once 'helper/NiwangHelper.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
date_default_timezone_set('Asia/Jakarta');
$helper = new NiwangHelper();
$id = $_GET['id'];

//data user
$sql = "SELECT * FROM `user` WHERE `id` = " . $id;
$data = (object)$mysqli->query($sql)->fetch_assoc();

//variable
$user = $_POST['user'];
$pass = ($_POST['pass'] == '' ? $data->pass : md5($_POST['pass']));
$foto = $helper->uploadImage('foto');
$foto = ($foto == '' ? $data->foto : $foto);

//validasi email
$sql = 'SELECT COUNT(*) as total FROM `user` WHERE `user` = "' . $user . '" AND `id` != ' . $id;
$check_email = $mysqli->query($sql)->fetch_assoc()['total'];
if ($check_email > 0) {
	header('Location: edit-user.php?id=' . $id . '&message=Username sudah digunakan');
	exit();
}

$sql = "UPDATE `user` SET
`user` = '" . $user . "',
`pass` = '" . $pass . "',
`foto` = '" . $foto . "'
WHERE `user`.`id` = " . $id;
$result = $mysqli->query($sql);
header('Location: user.php');
?>