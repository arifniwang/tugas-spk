<?php
session_start();
include 'dbconf.php';
include 'lhast.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');

$result = $mysqli->query("DELETE FROM `user` WHERE `id` = " . $_GET['id']);
if (!$result) {
	header('Location: user.php?message=' . $mysqli->connect_errno . " - " . $mysqli->connect_error);
	exit();
} else {
	header('Location: user.php?message=Data berhasil dihapus');
}
?>