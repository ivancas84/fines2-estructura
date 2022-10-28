<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("../config/config.php");
require_once("class/Container.php");
require_once("function/email.php");

class EmailConfirmacion {

  public $container;

  public function main($id){

    $mt = $this->container->getController("model_tools");
    $toma = $this->container->getDb()->get("toma",$id);
    $curso = $mt->labelCurso($toma,"cur_");
	  $idComision = $toma["cur_comision"];
    
    $horario_ = $this->container->getController("model_tools")->cursoHorario([$toma["curso"]]);
    $horario = count($horario_) ? $horario_[0]["horario"] : null;

    $t = $this->container->tools("toma")->value($toma);

    $fechaToma = $t["toma"]->_get("fecha_toma");
    $fechaFin = new DateTime('2022-12-23');
    $fechaFin = new DateTime('2022-12-30');

    // $fechaFin = clone $fechaToma;
    // $fechaFin->modify("+ 4 month");
  
    $body = '
<p>Hola ' . $t["docente"]->_get("nombres", "Xx Yy") . ' ' . $t["docente"]->_get("apellidos", "Xx Yy") . ':</p>
<p>Lea atentamente y verifique los datos del comprobante, serán utilizados para cobrar sus haberes. Si observa algún error, comuníquese inmediatamente para su corrección.</p>
<p>Conserve este comprobante para futuras referencias.</p>
<br>
<p>Se recuerda que el/la docente asume el compromiso de:</p>
<ul>
  <li>Asistir a la entrevista con el director para efectivizar la Toma de Posesión</li>
  <li>Efectuar clases presenciales</li>
  <li>Mantener al día todas las planillas de finalización (pueden ser solicitadas en cualquier momento)</li>
  <li>Respetar el formato y las instrucciones de las planillas de finalización (<a href="https://planfines2.com.ar/wp/planillas-de-finalizacion/">Descargar</a>)</li>
  <li>Avisar inmediatamente cualquier incorporación o baja de alumnos al CENS que no coincidan con la Lista de Alumnos (<a href="https://planfines2.com.ar/docente/alumnos-para-docente?comision='.$idComision.'">Ver</a>)</li>
  <li>Participar de las mesas examinadoras y reuniones a las que fuera convocado</li> 
  <li>Comunicar cualquier imprevisto a la coordinación administrativa del CENS</li>
  <li>Emplear las dos últimas clases del período para recuperación y mesa de exámen</li>
</ul>
<p>Comuníquese en primer término con los referentes, ellos conocen la realidad de cada alumno y ofrecen medios de contacto adicionales para la comunicación: <a href="https://planfines2.com.ar/docente/referentes-para-docente?comision='.$idComision.'">Contacto Referentes</a></p>
<p>Contacto de Whatsapp CENS 462 para cualquier consulta: <a href="https://api.whatsapp.com/send/?phone=54922167113326" target="_blank">22167113326</a></p>

<div style="margin-left:15px;width:600px;padding:20px;border:1px solid #d0d2d2;border-radius:5px;color:#444444">
      <h4 style="padding:0 0 12px 0;margin:0;font-weight:bold">Comprobante para Toma de posesión: <span>' . $t["docente"]->_get("apellidos","X") . ', ' . $t["docente"]->_get("nombres","Xx Yy") . ' DNI ' . $t["docente"]->_get("numero_documento") . '</span></h4>
      
      <div style="clear:both;display:block;margin:0 0 10px 0;padding:10px 0 10px 0;border-top:1px solid #d7d7d7">
        <table>
        <tbody>
          <tr>
            <td><strong>Sede:</strong></td>
            <td>' . $t["sede"]->_get("nombre") . ' (' . $t["sede"]->_get("numero") . ')</td>
          </tr>
          <tr>
            <td><strong>Comisión:</strong></td>
            <td>' . $t["sede"]->_get("numero") . $t["comision"]->_get("division") . '/' . $t["planificacion"]->_get("anio") . $t["planificacion"]->_get("semestre") . '</td>
          </tr>
          <tr>
            <td width="148"><strong>Fecha de toma:</strong></td>
            <td width="400">' . $t["toma"]->_get("fecha_toma","d/m/Y") . '</td>
          </tr>
          <tr>
            <td width="148"><strong>Fecha de finalización:</strong></td>
            <td width="400">' . $fechaFin->format("d/m/Y") . '</td>
          </tr>
          <tr>
            <td><strong>Asignatura:</strong></td>
            <td>' . $t["asignatura"]->_get("nombre") . '</td>
          </tr>
          <tr>
            <td><strong>Horario:</strong></td>
            <td>' . $horario . '</td>
          </tr>
          <tr>
            <td><strong>Horas Cátedra:</strong></td>
            <td>' . $t["curso"]->_get("horas_catedra") . '</td>
          </tr>
          
        </tbody>
        </table>
      </div>
   
</div>
-- 
<br>
Saluda a Usted muy atentamente:
<br>
Equipo de Coordinadores del Plan Fines 2 CENS 462
<br>https://planfines2.com.ar/
';


    $subject = "Comprobante para toma de posesión: " . $curso;

    $email =  (!Validation::is_empty($t["docente"]->_get("email_abc"))) ? $t["docente"]->_get("email_abc") : $t["docente"]->_get("email");

    $addresses = [
      $email => $t["docente"]->_get("nombres") . " " . $t["docente"]->_get("apellidos"),
    ];

    email($addresses, $subject, $body);

    return true;

  }

}
