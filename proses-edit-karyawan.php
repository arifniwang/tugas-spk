<?php
session_start();
include 'dbconf.php';
require_once 'helper/NiwangHelper.php';
if (!isset($_SESSION['login'])) header('Location: login-ui.php');
date_default_timezone_set('Asia/Jakarta');
$helper = new NiwangHelper();

if ($_SESSION['level'] != 'admin' && $_SESSION['id'] != $_GET['id']) {
	exit();
	header('Location: edit-karyawan.php?id=' . $_SESSION['id']);
} else {
	if ($_SESSION['level'] == 'admin') {
		$id = $_GET['id'];
	} else {
		$id = $_SESSION['id'];
	}
}

//data karyawan
$sql = "SELECT * FROM karyawan WHERE id_karyawan = " . $id;
$data = (object)$mysqli->query($sql)->fetch_assoc();

//variable
$nama = $_POST['nama'];
$nomor_telepon = $_POST['nomor_telepon'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$foto = $helper->uploadImage('foto');
$foto = ($foto == '' ? $data->foto : $foto);
$ijasah = $helper->uploadFile('ijasah');
$ijasah = ($ijasah == '' ? $data->ijasah : $ijasah);
$ktp = $helper->uploadFile('ktp');
$ktp = ($ktp == '' ? $data->ktp : $ktp);
$cv = $helper->uploadFile('cv');
$cv = ($cv == '' ? $data->cv : $cv);
$sertifikat = $helper->uploadFile('sertifikat');
$sertifikat = ($sertifikat == '' ? $data->sertifikat : $sertifikat);
$password = ($_POST['password'] == '' ? $data->password : md5($_POST['password']));
$sub_kriteria = $_POST['sub_kriteria'];

//validasi email
$sql = 'SELECT COUNT(*) as total FROM `karyawan` WHERE `email` = "' . $email . '" AND `id_karyawan` != ' . $id;
$check_email = $mysqli->query($sql)->fetch_assoc()['total'];
if ($check_email > 0) {
	header('Location: edit-karyawan.php?id=' . $id . '&message=Email sudah digunakan');
	exit();
}

//update karyawan
$sql = "UPDATE `karyawan` SET
`foto` = '" . $foto . "',
`nama` = '" . $nama . "',
`email` = '" . $email . "',
`nomor_telepon` = '" . $nomor_telepon . "',
`alamat` = '" . $alamat . "',
`jenis_kelamin` = '" . $jenis_kelamin . "',
`password` = '" . $password . "',
`cv` = '" . $cv . "',
`ktp` = '" . $ktp . "',
`ijasah` = '" . $ijasah . "',
`sertifikat` = '" . $sertifikat . "'
WHERE `id_karyawan` = $id";
$mysqli->query($sql);

foreach ($sub_kriteria as $id_kriteria => $value) {
	//kriteria
	$sql = 'SELECT * FROM kriteria WHERE id_kriteria=' . $id_kriteria;
	$data = $mysqli->query($sql)->fetch_assoc();
	$limit = $data['limit'];
	$bobot_kriteria = $data['bobot'];
	
	// nilai
	$sql = "SELECT * FROM nilai WHERE id_karyawan = " . $id . " AND id_kriteria = " . $id_kriteria;
	$nilai = $mysqli->query($sql)->fetch_assoc();
	if ($nilai === null) {
		//create new
		if ($data['tipe'] === 'Option') {
			//sub kriteria
			$sql = 'SELECT * FROM sub_kriteria WHERE id_sub_kriteria=' . $value;
			$sub_data = $mysqli->query($sql)->fetch_assoc();
			$id_sub_kriteria = $sub_data['id_sub_kriteria'];
			$bobot_sub = $sub_data['bobot'];
			$nilai = $bobot_kriteria * $bobot_sub;
			$nilai = round($nilai, 4);
			$value = $sub_data['sub_kriteria'];
			
			//inset data
			$sql = "INSERT INTO nilai (`id_nilai`,`id_karyawan`,`id_kriteria`,`id_sub_kriteria`,`value`,`bobot`,`bobot_sub`,`niali`) VALUES
		(NULL,$id_karyawan,$id_kriteria,$id_sub_kriteria,'" . $value . "',$bobot,$bobot_sub,$nilai)";
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
			$bobot_sub = $sub_data['bobot'];
			$nilai = $bobot_kriteria * $bobot_sub;
			$nilai = round($nilai, 4);
			
			//inset data
			$sql = "INSERT INTO nilai (`id_nilai`,`id_karyawan`,`id_kriteria`,`id_sub_kriteria`,`value`,`bobot`,`bobot_sub`,`niali`) VALUES
		(NULL,$id_karyawan,$id_kriteria,$id_sub_kriteria,'" . $value . "',$bobot,$bobot_sub,$nilai)";
			$mysqli->query($sql);
		}
	} else {
		//update data
		if ($data['tipe'] === 'Option') {
			//sub kriteria
			$sql = 'SELECT * FROM sub_kriteria WHERE id_sub_kriteria=' . $value;
			$sub_data = $mysqli->query($sql)->fetch_assoc();
			$id_sub_kriteria = $sub_data['id_sub_kriteria'];
			$bobot_sub = $sub_data['bobot'];
			$nilai = $bobot_kriteria * $bobot_sub;
			$nilai = round($nilai, 4);
			$value = $sub_data['sub_kriteria'];
			
			//update data
			$sql = "UPDATE `nilai` SET
			`id_sub_kriteria` = '" . $id_sub_kriteria . "',
			`bobot` = '" . $bobot_kriteria . "',
			`bobot_sub` = '" . $bobot_sub . "',
			`nilai` = '" . $nilai . "',
			`value` = '" . $value . "'
			WHERE `id_karyawan` = $id AND `id_kriteria` = $id_kriteria";
			$mysqli->query($sql);
		} else {
			//sub kriteria
			$sql = 'SELECT * FROM sub_kriteria WHERE `id_kriteria`=' . $id_kriteria . ' AND `min` <= ' . $value . ' AND `max` >= ' . $value;
			$sub_data = $mysqli->query($sql)->fetch_assoc();
			if ($sub_data === NULL) {
				$sql = 'SELECT * FROM sub_kriteria WHERE `id_kriteria`=' . $id_kriteria . ' AND `bobot` = 0';
				$sub_data = $mysqli->query($sql)->fetch_assoc();
			}
			$id_sub_kriteria = $sub_data['id_sub_kriteria'];
			$bobot_sub = $sub_data['bobot'];
			$nilai = $bobot_kriteria * $bobot_sub;
			$nilai = round($nilai, 4);
			
			//update data
			$sql = "UPDATE `nilai` SET
			`id_sub_kriteria` = '" . $id_sub_kriteria . "',
			`bobot` = '" . $bobot_kriteria . "',
			`bobot_sub` = '" . $bobot_sub . "',
			`nilai` = '" . $nilai . "',
			`value` = '" . $value . "'
			WHERE `id_karyawan` = $id AND `id_kriteria` = $id_kriteria";
			$mysqli->query($sql);
		}
	}
}

if ($_SESSION['level'] == 'admin') {
	header('Location: karyawan.php?message=Data berhasil disimpan');
} else {
	header('Location: dashboard-ui.php?message=Data berhasil disimpan');
}
?>