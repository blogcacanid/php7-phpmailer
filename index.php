<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('PHPMailer-master/src/Exception.php');
include('PHPMailer-master/src/PHPMailer.php');
include('PHPMailer-master/src/SMTP.php');

$mail = new PHPMailer;
$mail->isSMTP();

$mail->Host         = 'smtp.gmail.com';
$mail->Username     = 'email_gmail_anda@gmail.com'; // User GMAIL
$mail->Password     = 'password_email_gmail_anda'; // Password GMAIL
$mail->Port         = 465;
$mail->SMTPAuth     = true;
$mail->SMTPSecure   = 'ssl';
// $mail->SMTPDebug = 2; // untuk debug

$mail_from  = 'email_gmail_anda@gmail.com'; // Email pengirim
$from_name  = 'Cacan BLOG'; // Nama pengirim
$mail_to    = 'rony.chandra.kudus@gmail.com'; // Email penerima
$to_name    = ''; // Nama penerima
$subject    = 'Kirim Email Dengan SMTP GMAIL Menggunakan PHP Mailer - PHP 7'; // Judul Email
$message    = 'Pesan ini dikirim dari aplikasi yang menggunakan program PHP 7 dengan library PHP Mailer'; // Isi Email

$mail->setFrom($mail_from, $from_name);
$mail->addAddress($mail_to, $to_name);
$mail->isHTML(true); // untuk format html

// Menambahkan cc atau bcc 
//$mail->addCC('email_si_cc@emailnya.com');
//$mail->addBCC('email_si_bcc@emailnya.com');

$mail->Subject  = $subject;
$mail->Body     = $message;

$send = $mail->send();

if($send){ // Email berhasil dikirim
    echo '<p>Email <span style="color:green;">BERHASIL</span> dikirim<br />';
    echo '<p><a href="test_email.php">Kirim Ulang</a></p>';
}else{ // Email gagal dikirim
    echo '<p>Email <span style="color:red;">GAGAL</span> dikirim</h1><br /></p>';
    echo '<b>Mailer Error: </b><br />' . $mail->ErrorInfo .'<br />';
    echo '<p><a href="test_email.php">Kirim Ulang</a></p>';
}
?>