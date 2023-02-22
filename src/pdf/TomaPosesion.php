<?php

set_time_limit(0);  
require_once("controller/base.php");
require_once("function/array_group_value.php"); 
require_once("function/array_combine_key2.php"); 
require_once("Container.php");
require_once("tools/SpanishDateTime.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");
require_once("function/qr.php");
require_once("function/pdf/index.php");
require_once("function/pdf/header.php");
require_once("function/pdf/signature.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');

class TomaPosesionPdf extends BaseController{
 /**
   * Generar pdf constancia de alumno regular
   */
  public function main(){

    $qrcode = qr($_GET["url"]);
    $signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;

    $toma = $this->container->query("toma")->param("id",$_GET["id"])->fieldsTree()->one();

    $horario_ = $this->container->controller_("model_tools")->cursoHorario([$toma["curso"]]);
    $horario = count($horario_) ? $horario_[0]["horario"] : null;

    $t = $this->container->tools("toma")->value($toma);

    $fechaToma = $t["toma"]->_get("fecha_toma");
    $fechaFin = clone $fechaToma;
    $fechaFin->modify("+ 4 month");

    $c = htmlToPdfHeader($qrcode);
    $c .= '
<div class="title">
  TOMA DE POSESIÓN
</div>
<div class="content">
    <p>En La Plata, a los <span class="data">&nbsp;&nbsp;&nbsp;' . $fechaToma->format("d") . '&nbsp;&nbsp;&nbsp;</span> días del mes de <span class="data">&nbsp;&nbsp;&nbsp;' . $fechaToma->format("F") . '&nbsp;&nbsp;&nbsp;</span> de <span class="data">&nbsp;&nbsp;&nbsp;' . $fechaToma->format("Y") . '&nbsp;&nbsp;&nbsp;</span>, 
se procede a dar toma de posesión al/la docente: <span class="data">&nbsp;&nbsp;&nbsp;' . $t["docente"]->_get("apellidos", "XX YY")  . ' ' . $t["docente"]->_get("nombres", "Xx Yy")  . '&nbsp;&nbsp;&nbsp;</span> DNI <span class="data">&nbsp;&nbsp;&nbsp;' . $t["docente"]->_get("numero_documento")  . '&nbsp;&nbsp;&nbsp;</span>.</p>
<p>Que se desempeñará en las asignaturas correspondientes al <strong>PLAN DE ESTUDIOS R6321/95-R713/17, del plan FinEs 2 de Terminalidad de Nivel Secundario</strong>, dependiente de la Dirección de Educación de Adultos según el siguiente detalle:</p>

<table>
        <tbody>
          <tr>
            <td><strong>CENS Nº:</strong></td>
           <td>462</td>
          </tr>
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
';
    $c .= htmlToPdfSignature($signature);
    $html = htmlToPdfIndex($c); 


  
    // echo $html;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);

    $mpdf->WriteHTML($html);

    $mpdf->Output("toma_posesion_" . $t["docente"]->_get("numero_documento") . ".pdf", 'I');
  }
}