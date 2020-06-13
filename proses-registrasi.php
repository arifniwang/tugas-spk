<?php
session_start();
include 'dbconf.php';
require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';
require 'helper/NiwangHelper.php';

//session validation
if (isset($_SESSION['login'])) header('Location: dashboard-ui.php');
date_default_timezone_set('Asia/Jakarta');
$helper = new NiwangHelper();
//$helper->dd($_POST);

//main parameter
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['pass'];

//validasi email
$sql = 'SELECT COUNT(*) as total FROM `karyawan` WHERE `email` = "' . $email . '" ';
$check_email = $mysqli->query($sql)->fetch_assoc()['total'];
if ($check_email > 0) {
	header('Location: registrasi.php?message=Email sudah digunakan');
	exit();
}


/**
 * DATA KARYAWAN
 */
$sql = "INSERT INTO `karyawan` (`id_karyawan`,`nama`,`email`,`password`) VALUES (NULL,'" . $nama . "','" . $email . "','" . md5($password) . "')";
$result = $mysqli->query($sql);
$id_karyawan = $mysqli->query("SELECT MAX(`id_karyawan`) AS max FROM `karyawan`")->fetch_assoc()['max'];


/**
 * PENILAIAN
 */
$sql = 'SELECT * FROM kriteria';
$data = $mysqli->query($sql);
while ($row = $data->fetch_assoc()) {
	//inset data
	$sql = "INSERT INTO nilai (`id_nilai`,`id_karyawan`,`id_kriteria`,`nilai`) VALUES (NULL,$id_karyawan,".$row['id_kriteria'].",0)";
	$mysqli->query($sql);
}

/**
 * SEND EMAIL
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
//	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'smtp.googlemail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'emailmu@gmail.com';
	$mail->Password = 'passwordemailmu';
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	$mail->Port = 465;
	
	//Recipients
	$mail->setFrom('emailmu', 'Energi Bangsa');
	$mail->addAddress($email);
	$mail->addReplyTo('emailmu', 'Energi Bangsa');
	
	// Content
	$mail->isHTML(true);
	$mail->Subject = 'Registrasi Pendaftaran Karyawan';
	$mail->Body = '<center>
	<h2>Registrasi Berhasil</h2>
	<p>Terimakasih telah melakukan pendaftaran Karyawan pada PT Energi Bangsa.</p>
	<p>Silahkan klik link dibawah ini untuk Aktivasi akun anda.</p>
	<a href="http://' . $_SERVER[HTTP_HOST] . '/ptatm/aktivasi.php?key=' . base64_encode($id_karyawan) . '" style="background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Aktivasi</a></center>';

	$mail->send();
} catch (Exception $e) {
	header("Location: registrasi.php?message=Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
	exit();
}


header('Location: login-ui.php?message=Registrasi berhasil');
?>
