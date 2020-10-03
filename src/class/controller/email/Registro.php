<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("../config/config.php");
require_once("class/Container.php");
require_once("class/controller/Base.php");

class RegistroEmail extends Base {

  public function main($id){

    $toma = $this->container->getDb()->get("toma",$id);

    $nombre = $toma["doc_nombres"] . " " . $toma["doc_apellidos"];
    $email =  $toma["doc_email_abc"];
    $ige = $toma["cur_ige"];
    $asignatura = $toma["cur_asi_nombre"];
    $horasCatedra = $toma["cur_horas_catedra"];
    $this->email($nombre, $email, $ige, $asignatura, $horasCatedra);
  }


  public function email($nombre, $email, $ige, $asignatura, $horasCatedra){
      // Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
        
          //Server settings
          //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
          $mail->isSMTP();                                            // Send using SMTP
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
          $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
          $mail->CharSet = 'UTF-8';

          $mail->Host       = EMAIL_HOST;                    // Set the SMTP server to send through
          $mail->Username   = EMAIL_USER;                     // SMTP username
          $mail->Password   = EMAIL_PASSWORD;                               // SMTP password
          

          //Recipients
          $mail->setFrom(EMAIL_FROM_ADRESS, EMAIL_FROM_NAME);
          
          
          $mail->addAddress($email, $nombre);     // Add a recipient

          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Toma de posesión: ' . $asignatura . ' IGE ' . $ige;
          $mail->Body    = '<p>Hola ' . $nombre  . '</p>
<p>Usted ha recibido este email porque fue designado/a en la asignatura ' . $asignatura . ' IGE ' . $ige . "</p>
<p>Para completar su toma de posesión, necesitamos que responda este email y nos envíe por este medio una foto de su DNI y Declaración Jurada de Cargos</p>
<br>
<p>Para la declaración Jurada puede utilizar el siguiente formato: <a href=\"http://cens456.planfines2.com.ar/wp-content/uploads/2019/02/declaracion-jurada-cargos-1.pdf\">Descargar</a></p>
<br>
-- 
<br>
Saluda a Usted muy atentamente:
<br>
Equipo de Coordinadores del Plan Fines 2 CENS 456 UMuPla
<br>http://cens456.planfines2.com.ar
";

          $mail->send();
          
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
  }
}




