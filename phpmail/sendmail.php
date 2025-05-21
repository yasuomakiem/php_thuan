<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'sv3.tmail.vn';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'noreply@alocool.com';                 // SMTP username
    $mail->Password = "Sqtt@886596";                           // SMTP password
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('noreply@alocool.com', 'Mailer');
    $mail->addAddress('web300k.com@gmail.com');               // Name is optional


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Manh Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}