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

class ConstanciaSolicitudInfoPdf extends BaseController{
 /**
   * Generar pdf constancia de alumno regular
   */
  public function main(){

    $qrcode = qr($_GET["url"]);
    $signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;

    $this->alumno = $this->container->query("alumno")->param("id",$_GET["id"])->fields()->one();

    $v = $this->container->tools("alumno")->value($this->alumno);
    $date = new SpanishDateTime();
    $mpdf = new \Mpdf\Mpdf();

    $c = htmlToPdfHeader($qrcode);
    $c .= '
<div class="title">
  SOLICITUD DE INFORMACION DE ALUMNO
</div>
<div class="content">
  <p>La Dirección de la Escuela de Educación CENS Nº 462 de La Plata, 
solicita por medio de la presente que se emita la documentación necesaria de <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("apellidos", "X") . ' ' . $v["persona"]->_get("nombres","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span> DNI Nº <span class="data">&nbsp;&nbsp;&nbsp;' . $v["persona"]->_get("numero_documento","Xx Yy") . '&nbsp;&nbsp;&nbsp;</span>
para completar su legajo y pueda continuar sus estudios en este establecimiento:
   <ul>
     <li>Constancia de estudios para inscripción.</li>
     <li>Certificado o analitico para emisión de título.</li>
    </ul>
  </p>
  <p>A pedido del/de la interesado/a y al sólo efecto de ser presentado ante las autoridades que se lo exijan, se extiene la presente en La Plata a los <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("d") . '&nbsp;&nbsp;&nbsp;</span> días
del mes de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("F") . '&nbsp;&nbsp;&nbsp;</span> 
de <span class="data">&nbsp;&nbsp;&nbsp;' . $date->format("Y") . '&nbsp;&nbsp;&nbsp;</span>.
  </p>
</div>
';
    $c .= htmlToPdfSignature($signature);
    $html = htmlToPdfIndex($c); 

    // echo $html;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);

    $mpdf->WriteHTML($html);

    $mpdf->Output("constancia_solicitud_info_" . $v["persona"]->_get("numero_documento") . ".pdf", 'I');
  }
}