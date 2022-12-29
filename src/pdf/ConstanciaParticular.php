<?php

set_time_limit(0);  
require_once("controller/Base.php");
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
require_once("function/pdf/extiende-presente.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/" . PATH_ROOT . '/vendor/autoload.php');

class ConstanciaParticularPdf extends BaseController{
 /**
   * Generar pdf constancia de alumno regular
   */
  public function main(){

    $qrcode = qr($_GET["url"]);
    $signature = array_key_exists("firma", $_GET)? settypebool($_GET["firma"]) : true;
    

    $modelTools = $this->container->controller_("model_tools");

    $mpdf = new \Mpdf\Mpdf();

    $c = htmlToPdfHeader($qrcode);
    $c .= '<div class="content">';
    $c .= '<p>La Dirección de la Escuela de Educación CENS Nº 462 de La Plata, 
hace constar por la presente que <strong>CASTAÑEDA Iván César DNI Nº 31073351</strong> revista en el Item de <strong>personal docente</strong> con función de coordinador administrativo del Programa Fines 2 Trayecto Secundario
los días <strong>Lunes, Martes, Jueves y Viernes en el horario de 18 a 21 hs.</strong>
  </p>

';
    $c .= htmlToPdfExtiendePresente($signature);


    $c .= htmlToPdfSignature($signature);
    $c .= '</div>';

    $html = htmlToPdfIndex($c); 


  
  // echo $html;
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetProtection(["print"]);

    $mpdf->WriteHTML($html);

    $mpdf->Output("constancia_particular.pdf", 'I');
  }
}