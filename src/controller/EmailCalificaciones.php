<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("../config/config.php");
require_once("class/Container.php");
require_once("function/email2.php");

class EmailCalificaciones {

  public $container;

  public function main($idAlumno){

    $alumnoTools = $this->container->getController("alumno_tools");
    $alumnoTools->init($idAlumno);
    $calificacionesAprobadas = $alumnoTools->getCalificacionesAprobadas();
    $disposicionesRestantes = $alumnoTools->disposicionesPendientes();
    $a = $alumnoTools->getValue();
    $p = $a["persona"];
    echo "<pre>";

    $subject = "Informe Calificaciones Plan Fines 2 - CENS 462";
    
    $body = '
<div style="margin-left:15px;width:600px;padding:20px;border:1px solid #d0d2d2;border-radius:5px;color:#444444">
      <h4 style="padding:0 0 12px 0;margin:0;font-weight:bold">Asignaturas Aprobadas: <span>' . $p->_get("apellidos","X") . ', ' . $p->_get("nombres","Xx Yy") . ' DNI ' . $p->_get("numero_documento") . '</span></h4>
      <div style="clear:both;display:block;margin:0 0 10px 0;padding:10px 0 10px 0;border-top:1px solid #d7d7d7">
        <table>
        <tbody>
          <tr>
            <th>Asignatura</th><th>Tramo</th><th>Calificación</th>
          </tr>
';

    for($i = 0; $i < count($calificacionesAprobadas)  ; $i++){
      $c = $this->container->tools("calificacion")->value($calificacionesAprobadas[$i]);
      $nota =  (intval($c["calificacion"]->_get("nota_final")) >= 7) ? $c["calificacion"]->_get("nota_final") : $c["calificacion"]->_get("crec");

      $body .= '
          <tr>
            <td>' . $c["asignatura1"]->_get("nombre"). '</td><td>' . $c["planificacion1"]->_get("anio") . '/' . $c["planificacion1"]->_get("semestre") . '</td><td>' . $nota . '</td>
          </tr>
';
    }

    $body .= '
        </tbody>
        </table>
      </div>
</div>
<div style="margin-left:15px;width:600px;padding:20px;border:1px solid #d0d2d2;border-radius:5px;color:#444444">
      <h4 style="padding:0 0 12px 0;margin:0;font-weight:bold">Asignaturas Pendientes: <span>' . $p->_get("apellidos","X") . ', ' . $p->_get("nombres","Xx Yy") . ' DNI ' . $p->_get("numero_documento") . '</span></h4>
      <div style="clear:both;display:block;margin:0 0 10px 0;padding:10px 0 10px 0;border-top:1px solid #d7d7d7">
        <table>
        <tbody>
          <tr>
            <th>Asignatura</th><th>Tramo
          </tr>
';

    for($i = 0; $i < count($disposicionesRestantes)  ; $i++){
      $di = $this->container->tools("disposicion_pendiente")->value($disposicionesRestantes[$i]);

      $body .= '
          <tr>
            <td>' . $di["asignatura"]->_get("nombre"). '</td><td>' . $di["planificacion"]->_get("anio") . '/' . $di["planificacion"]->_get("semestre") . '</td>
          </tr>
';
    }

    $body .= '
        </tbody>
        </table>
      </div>
</div>
<br>

-- 
<br>
Saluda a Usted muy atentamente:
<br>
Equipo de Coordinadores del Plan Fines 2 CENS 462
<br>https://planfines2.com.ar/
';


    $email =  $p->_get("email");
    //$email = "ivancas84@gmail.com";
    $addresses = [
      $email => $p->_get("nombres", "Xx Yy") . " " . $p->_get("apellidos", "Xx Yy"),
    ];

    email2(EMAIL_HOST_A, EMAIL_USER_A, EMAIL_PASSWORD_A, EMAIL_FROM_ADRESS_A, EMAIL_FROM_NAME_A, $addresses, $subject, $body);

    return true;

  }

}
