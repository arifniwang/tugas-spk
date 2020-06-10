<?php
session_start();
include 'dbconf.php';
require_once 'helper/NiwangHelper.php';
if (isset($_SESSION['login'])) header('Location: dashboard-ui.php');
date_default_timezone_set('Asia/Jakarta');
$helper = new NiwangHelper();
//$helper->dd($_POST);

$nama = $_POST['nama'];
$nomor_telepon = $_POST['nomor_telepon'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$foto = $helper->uploadImage('foto');
$foto = ($foto == '' ? '-' : $foto);
$password = $_POST['pass'];
$sub_kriteria = $_POST['sub_kriteria'];

echo 'nama : ' . $nama . '<br>';
echo 'nomor_telepon : ' . $nomor_telepon . '<br>';
echo 'email : ' . $email . '<br>';
echo 'alamat : ' . $alamat . '<br>';
echo 'jenis_kelamin : ' . $jenis_kelamin . '<br>';
echo 'foto : ' . $foto . '<br>';
echo 'password : ' . $password . '<br>';
echo 'sub_kriteria : ' . json_encode($sub_kriteria) . '<br>';

//validasi email
$sql = 'SELECT COUNT(*) as total FROM `karyawan` WHERE `email` = "' . $email . '" ';
$check_email = $mysqli->query($sql)->fetch_assoc()['total'];
if ($check_email > 0) {
	header('Location: registrasi.php?message=Email sudah digunakan');
	exit();
}

$sql = "INSERT INTO `karyawan` (`id_karyawan`,`foto`,`nama`,`email`,`nomor_telepon`,`alamat`,`jenis_kelamin`,`password`) VALUES
(NULL,'" . $foto . "','" . $nama . "','" . $email . "','" . $nomor_telepon . "','" . $alamat . "','" . $jenis_kelamin . "','" . md5($password) . "')";
$result = $mysqli->query($sql);
$id_karyawan = $mysqli->query("SELECT MAX(`id_karyawan`) AS max FROM `karyawan`")->fetch_assoc()['max'];

//loop from post dat
foreach ($sub_kriteria as $id_kriteria => $value) {
	//kriteria
	$sql = 'SELECT * FROM kriteria WHERE id_kriteria=' . $id_kriteria;
	$data = $mysqli->query($sql)->fetch_assoc();
	$limit = $data['limit'];
	
	if ($data['tipe'] === 'Option') {
		//sub kriteria
		$sql = 'SELECT * FROM sub_kriteria WHERE id_sub_kriteria=' . $value;
		$sub_data = $mysqli->query($sql)->fetch_assoc();
		$id_sub_kriteria = $sub_data['id_sub_kriteria'];
		$bobot = $sub_data['bobot'];
		$value = $sub_data['sub_kriteria'];
		
		//inset data
		$sql = "INSERT INTO nilai (`id_nilai`,`id_karyawan`,`id_kriteria`,`id_sub_kriteria`,`bobot`,`value`) VALUES
		(NULL,$id_karyawan,$id_kriteria,$id_sub_kriteria,$bobot,'" . $value . "')";
		$sub_data = $mysqli->query($sql);
		
	} else {
		//sub kriteria
		$sql = 'SELECT * FROM sub_kriteria WHERE `id_kriteria`=' . $id_kriteria . ' AND `min` <= ' . $value . ' AND `max` >= ' . $value;
		$sub_data = $mysqli->query($sql)->fetch_assoc();
		if ($sub_data === NULL) {
			$sql = 'SELECT * FROM sub_kriteria WHERE `id_kriteria`=' . $id_kriteria . ' AND `bobot` = 0';
			$sub_data = $mysqli->query($sql)->fetch_assoc();
		}
		$id_sub_kriteria = $sub_data['id_sub_kriteria'];
		$bobot = $sub_data['bobot'];
		
		//inset data
		$sql = "INSERT INTO nilai (`id_nilai`,`id_karyawan`,`id_kriteria`,`id_sub_kriteria`,`bobot`,`value`) VALUES
		(NULL,$id_karyawan,$id_kriteria,$id_sub_kriteria,$bobot,'" . $value . "')";
		$sub_data = $mysqli->query($sql);
	}
}
header('Location: login-ui.php?message=Registrasi berhasil');
?>