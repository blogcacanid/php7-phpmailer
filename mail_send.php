<?php
include('header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('PHPMailer-master/src/Exception.php');
include('PHPMailer-master/src/PHPMailer.php');
include('PHPMailer-master/src/SMTP.php');

$mail = new PHPMailer;
$mail->isSMTP();

$mail_from      = 'email_gmail_anda@gmail.com'; // Isikan dengan email anda (email pengirim)
$from_name      = 'Cacan BLOG'; // Isikan dengan nama pengirim
$mail_to        = $_POST['mail_to']; // Ambil email penerima dari inputan form
$subject        = $_POST['subject']; // Ambil subject dari inputan form
$message        = $_POST['message']; // Ambil message dari inputan form
$attachment     = $_FILES['attachment']['name']; // Ambil nama file yang di upload

$mail->Host         = 'smtp.gmail.com';
$mail->Username     = $mail_from; // Email Pengirim
$mail->Password     = 'password_email_gmail_anda'; // Isikan dengan Password email pengirim
$mail->Port         = 465;
$mail->SMTPAuth     = true;
$mail->SMTPSecure   = 'ssl';
// $mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

$mail->setFrom($mail_from, $from_name);
$mail->addAddress($mail_to, '');
$mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

// Load file content.php
ob_start();
include "mail_content.php";

$content = ob_get_contents(); // Ambil isi file content.php dan masukan ke variabel $content
ob_end_clean();

$mail->Subject = 'Contact Us - ' . $subject;
$mail->Body = $content;
$mail->AddEmbeddedImage('image/logo.png', 'logo-cacan-blog', 'https://blog.cacan.id/wp-content/uploads/my_blog/favicon.png'); // Aktifkan jika ingin menampilkan gambar dalam email

if(empty($attachment)){ // Jika tanpa attachment
    $send = $mail->send();
    if($send){ // Jika Email berhasil dikirim
        echo '<p>Email <span style="color:green;">BERHASIL</span> dikirim</p><br />';
        echo '<a class="btn btn-success col-sm-5" href="contact.php"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a>';
    }else{ // Jika Email gagal dikirim
        echo '<p>Email <span style="color:red;">GAGAL</span> dikirim</p><br />';
        echo '<b>Mailer Error: </b><br />' . $mail->ErrorInfo .'<br />';
        echo '<a class="btn btn-danger col-sm-5" href="contact.php"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a>';
        // echo '<p>ERROR<br /><small>Error while sending email: '.$mail->getError().'</small></p>'; // Aktifkan untuk mengetahui error message
    }
}else{ // Jika dengan attachment
    $tmp = $_FILES['attachment']['tmp_name'];
    $size = $_FILES['attachment']['size'];
    if($size <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
        $mail->addAttachment($tmp, $attachment); // Add file yang akan di kirim
        $send = $mail->send();
        if($send){ // Jika Email berhasil dikirim
            echo '<p>Email berhasil dikirim</p><br />';
            echo '<a class="btn btn-success col-sm-5" href="contact.php"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a>';
        }else{ // Jika Email gagal dikirim
            echo '<p>Email <span style="color:red;">GAGAL</span> dikirim</p><br />';
            echo '<b>Mailer Error: </b><br />' . $mail->ErrorInfo .'<br />';
            echo '<a class="btn btn-success col-sm-5" href="contact.php"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a>';
            // echo '<p>ERROR<br /><small>Error while sending email: '.$mail->getError().'</small></p>'; // Aktifkan untuk mengetahui error message
        }
    }else{ // Jika Ukuran file lebih dari 25 MB
        echo '<b>Mailer Error: </b><br />';
        echo '<p style="color:red;">Ukuran file attachment maksimal 25 MB</p><br />';
        echo '<a class="btn btn-danger col-sm-5" href="contact.php"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a>';
    }
}
include('footer.php');
?>