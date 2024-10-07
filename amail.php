<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // This loads the Composer autoloader

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                  // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';          // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                         // Enable SMTP authentication
    $mail->Username   = 'vasanth100ff@gmail.com';    // SMTP username
    $mail->Password   = 'eyoi gfep mxmk fyyp';              // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                          // TCP port to connect to

    //Recipients
    $mail->setFrom('vasanth100ff@gmail.com');
    $mail->addAddress('riffath786mohamed@gmail.com'); // Add a recipient

    //Content
    $mail->isHTML(true);                              // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
