<?php

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
	//Server settings
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
	$mail->isSMTP();                                            // Send using SMTP
	$mail->Host = 'smtp.googlemail.com';                    // Set the SMTP server to send through
	$mail->SMTPAuth = true;                                   // Enable SMTP authentication
	$mail->Username = 'arif.niwank1@gmail.com';                     // SMTP username
	$mail->Password = 'kucintakau_66';                               // SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	$mail->Port = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
	
	//Recipients
	$mail->setFrom('arif.niwank1@gmail.com', 'Arif Niwang Djati');
	$mail->addAddress('niwang@crocodic.com', 'Arif Niwang');     // Add a recipient
	$mail->addAddress('arif.niwank2@gmail.com');               // Name is optional
	$mail->addReplyTo('arif.niwank@gmail.com', 'Niwang');
	$mail->addCC('112201705890@mhs.dinus.ac.id');
	$mail->addBCC('29dyah@gmail.com');
	
	// Attachments
	$mail->addAttachment('uploads/file/company_profile_2018.pdf');         // Add attachments
	$mail->addAttachment('uploads/file/company_profile_2020.pdf', 'Company Profile 2020');    // Optional name
	
	// Content
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'Example Send SMTP Email';
	$mail->Body = 'This is the HTML message body <b>in bold!</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	$mail->send();
	echo 'Message has been sent';
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}