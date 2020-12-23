<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader

require $_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php';

require_once("../config/config.php");
require_once("class/Container.php");
require_once("function/email.php");

class ConfirmacionEmail {

  public $entityName;
  public $container;

  public function main($id){

    $toma = $this->container->getDb()->get("toma",$id);
    
    $horario_ = $this->container->getController("model_tools")->cursoHorario([$toma["curso"]]);
    $horario = count($horario_) ? $horario_[0]["horario"] : null;

    $t = $this->container->getRel("toma")->value($toma);

    $body = '
<p>Hola ' . $t["docente"]->_get("nombres", "Xx Yy") . ', a continuación se indica el comprobante de toma de posesión.</p>
<p>Descargue la lista de alumnos del siguiente enlace: <a href="http://planfines2.com.ar/registro-docente/lista-alumnos?id=' . $t["toma"]->_get("id") . '">Lista de alumnos</a></p>    
<p>Descargue las planillas de finalización de semestre e instrucciones del siguiente enlace: <a href="http://cens456.planfines2.com.ar/docentes/">Finalización de semestre</a></p> 
<p>Únase al grupo de Whatsapp de docentes: <a href="https://chat.whatsapp.com/KRDvOU737LEK73SHnuS0Dr">Grupo docentes</a> o envíe un Whatsapp a 1172870518 para que podamos agregarlo</p>

<div style="margin-left:15px;width:600px;padding:20px;border:1px solid #d0d2d2;border-radius:5px;color:#444444">
    
      <h4 style="padding:0 0 12px 0;margin:0;font-weight:bold">Toma de posesión: <span>' . $t["docente"]->_get("apellidos","X") . ', ' . $t["docente"]->_get("nombres","Xx Yy") . ' DNI ' . $t["docente"]->_get("numero_documento") . '</span></h4>
      
      <div style="clear:both;display:block;margin:0 0 10px 0;padding:10px 0 10px 0;border-top:1px solid #d7d7d7">
      <p>Por medio de la presente se deja constancia que el docente ha tomado posesión en la asignatura correspondiente al <strong>PLAN DE ESTUDIOS R6321/95-R713/17, del plan FinEs 2 de Terminalidad de Nivel Secundario</strong>, dependiente de la Dirección de Educación de Adultos según se expresa en el siguiente detalle.</p>
      </div>
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
            <td width="400">' . $t["calendario"]->_get("fin","d/m/Y") . '</td>
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
      <div style="clear:both;display:block;margin:0 0 10px 0;padding:10px 0 10px 0;border-top:1px solid #d7d7d7">
        <p>El/la docente asume el compromiso de: participar en las mesas examinadoras a las que fuera convocado, colaborar con el referente de la sede y entregar una copia impresa de las planillas solicitadas al finalizar el cuatrimestre al CENS al cual corresponde la comisión y sede. Declara no estar en uso de licencia, cambio de funciones o superposición horaria).</p>
      </div>    
    
</div>
-- 
<br>
Saluda a Usted muy atentamente:
<br>
Equipo de Coordinadores del Plan Fines 2 CENS 456 UMuPla
<br>http://cens456.planfines2.com.ar
';


    $subject = "Comprobante toma de posesión: " . $t["asignatura"]->_get("nombre") . " IGE " . $t["curso"]->_get("ige");

    $email =  (!Validation::is_empty($t["docente"]->_get("email_abc"))) ? $t["docente"]->_get("email_abc") : $t["docente"]->_get("email");

    $addresses = [
      $email => $t["docente"]->_get("nombres") . " " . $t["docente"]->_get("apellidos"),
    ];

    email($addresses, $subject, $body);

    return true;

  }

}