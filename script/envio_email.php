<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

require_once("../config/config.php");
require_once("class/Container.php");


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->CharSet = 'UTF-8';

    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->Username   = 'coordinadores.cens456@gmail.com';                     // SMTP username
    $mail->Password   = 'Domicilio60148';                               // SMTP password
    

    //Recipients
    $mail->setFrom('coordinadores.cens456@gmail.com', 'Coordinadores CENS 456');
    $mail->addAddress('ivancas84@gmail.com', 'Iván Castañeda');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Hola Iván';
    $mail->Body    = 'Nuevamente estoy probando que te llegue <b>en negrita!</b> y con áéíóúñ';
    $mail->AltBody = 'Alternativamente te envío este contenido';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}