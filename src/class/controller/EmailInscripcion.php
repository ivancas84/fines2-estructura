<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("../config/config.php");
require_once("class/Container.php");
require_once("function/email2.php");

class EmailInscripcion {

  public $container;

  public function main($id){
    $p = $this->container->getValue("persona")->_fromArray(
      $this->container->getDb()->get("persona",$id), 
      "set"
    );

    $subject = "Preinscripción Plan Fines 2 - CENS 462";
    
    $body = '
<p>Hola ' . $p->_get("nombres", "Xx Yy") . ' ' . $p->_get("apellidos", "Xx Yy") . ', usted ha recibido este email porque ha completado el formulario de preinscripción al Plan Fines 2 - CENS 462.</p>
<p>Si usted no ha completado ningún formulario y considera que es un error, ignore este email.</p>
<br>
<p>Para completar su preinscripción <strong>responda este email</strong> confirmando que los datos indicados a continuación son correctos.</p>
<p>En el caso de que haya que hacer alguna corrección, indíquenos la misma y posteriormente le reenviaremos el email.</p>
<div style="margin-left:15px;width:600px;padding:20px;border:1px solid #d0d2d2;border-radius:5px;color:#444444">
      <h4 style="padding:0 0 12px 0;margin:0;font-weight:bold">Preinscripción CENS 462: <span>' . $p->_get("apellidos","X") . ', ' . $p->_get("nombres","Xx Yy") . '</span></h4>
      <div style="clear:both;display:block;margin:0 0 10px 0;padding:10px 0 10px 0;border-top:1px solid #d7d7d7">
        <table>
        <tbody>
          <tr>
            <td><strong>Nombres:</strong></td>
            <td>' . $p->_get("nombres","Xx Yy") . '</td>
          </tr>
          <tr>
            <td><strong>Apellidos:</strong></td>
            <td>' . $p->_get("apellidos","Xx Yy") . '</td>
          </tr>
          <tr>
            <td><strong>Número de Documento:</strong></td>
            <td>' . str_replace("_","",$p->_get("numero_documento","Xx Yy")) . '</td>
          </tr>
          <tr>
            <td><strong>CUIL:</strong></td>
            <td>' . str_replace("_","",$p->_get("cuil","Xx Yy")) . '</td>
          </tr>
          <tr>
            <td><strong>Género:</strong></td>
            <td>' . $p->_get("genero","Xx Yy") . '</td>
          </tr>
          <tr>
            <td><strong>Fecha de Nacimiento:</strong></td>
            <td>' . $p->_get("fecha_nacimiento","d/m/Y") . '</td>
          </tr>
          <tr>
            <td><strong>Lugar de Nacimiento:</strong></td>
            <td>' . $p->_get("lugar_nacimiento","Xx Yy") . '</td>
          </tr>
          <tr>
            <td><strong>Teléfono:</strong></td>
            <td>' . $p->_get("telefono") . '</td>
          </tr>
          <tr>
            <td><strong>Email:</strong></td>
            <td>' . $p->_get("email","xx yy") . '</td>
          </tr>
          
        </tbody>
        </table>
      </div>
</div>
<p><strong>IMPORTANTE:</strong> La preinscripción no asegura un lugar, posteriormente chequearemos su legajo y le confirmaremos</p> 
-- 
<br>
Saluda a Usted muy atentamente:
<br>
Equipo de Coordinadores del Plan Fines 2 CENS 462
<br>https://planfines2.com.ar/
';


    $email =  $p->_get("email");

    $addresses = [
      $email => $p->_get("nombres", "Xx Yy") . " " . $p->_get("apellidos", "Xx Yy"),
    ];

    email2(EMAIL_HOST_A, EMAIL_USER_A, EMAIL_PASSWORD_A, EMAIL_FROM_ADRESS_A, EMAIL_FROM_NAME_A, $addresses, $subject, $body);

    return true;

  }

}
